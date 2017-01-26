<?php
namespace iRESTful\CompilersCli\Infrastructure\Applications;
use iRESTful\CompilersCli\Domain\Applications\CompilersCliApplication;
use iRESTful\Https\Applications\HttpApplication;
use iRESTful\CompilersCli\Domain\Exceptions\CompilersCliException;
use iRESTful\Https\Domain\Exceptions\HttpException;
use iRESTful\Https\Domain\Responses\Adapters\HttpResponseAdapter;

final class ConcreteCompilersCliApplication implements CompilersCliApplication {
    private $application;
    private $responseAdpater;
    private $port;
    private $outputPath;
    public function __construct(HttpApplication $application, HttpResponseAdapter $responseAdpater, int $port, string $outputPath) {
        $this->application = $application;
        $this->responseAdpater = $responseAdpater;
        $this->port = $port;
        $this->outputPath = $outputPath;
    }

    public function execute(string $jsonFile) {

        $getData = function(string $path, string $fileName) use(&$getData) {

            //get the root data:
            $data = json_decode(file_get_contents(realpath($path.'/'.$fileName)), true);

            //code:
            if (isset($data['project']['code']['file'])) {
                $data['project']['code']['source'] = trim(str_replace('<?php', '', file_get_contents($path.'/'.$data['project']['code']['file'])));
                unset($data['project']['code']['file']);
            }

            //get the project data:
            if (isset($data['project']['data'])) {
                $data['project']['data'] = json_decode(file_get_contents(realpath($path.'/'.$data['project']['data'])), true);
            }

            //get the project samples:
            if (isset($data['project']['samples'])) {
                $data['project']['samples'] = json_decode(file_get_contents(realpath($path.'/'.$data['project']['samples'])), true);
            }

            //parents:
            if (isset($data['project']['parents'])) {
                foreach($data['project']['parents'] as $keyname => $oneData) {
                    $filePath = realpath($path.'/'.$oneData['file']);

                    $exploded = explode('/', $filePath);
                    $fileName = array_pop($exploded);
                    $filePath = implode('/', $exploded);
                    $data['project']['parents'][$keyname]['source'] = $getData($filePath, $fileName);
                    unset($data['project']['parents'][$keyname]['file']);
                }
            }

            return $data;
        };

        if (!file_exists($jsonFile)) {
            throw new CompilersCliException('The given json file ('.$jsonFile.') is invalid.');
        }

        $exploded = explode('/', $jsonFile);
        $fileName = array_pop($exploded);
        $path = implode('/', $exploded);

        try {

            $response = $this->application->execute([
                'uri' => '/',
                'method' => 'post',
                'port' => $this->port,
                'request_parameters' => $getData($path, $fileName)
            ]);

            if ($response->isError()) {
                $exception = $this->responseAdpater->fromHttpResponseToException($response);
                throw new CompilersCliException('The compiler returned an error.', $exception);
            }

            //save the response on disk:
            $filePath = tempnam("tmp", uniqid('zip'));
            file_put_contents($filePath, $response->getContent());

            //open the zip file:
            $zip = new \ZipArchive();
            if ($zip->open($filePath) !== true) {
                throw new CompilersCliException('The zip file produced by the compiler is invalid.');
            }

            //unzip the content to the output directory:
            $zip->extractTo($this->outputPath);
            $zip->close();

        } catch (HttpException $exception) {
            throw new CompilersCliException('There was a problem while compiling: '.$exception->getMessage());
        }

    }

}
