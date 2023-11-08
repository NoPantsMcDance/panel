<?php

namespace Pterodactyl\Http\Controllers\Api\Client\Servers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Pterodactyl\Exceptions\DisplayException;
use Pterodactyl\Models\Server;
use Pterodactyl\Models\Permission;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Pterodactyl\Models\Filters\MultiFieldServerFilter;
use Pterodactyl\Repositories\Eloquent\ServerRepository;
use Pterodactyl\Transformers\Api\Client\ServerTransformer;
use Pterodactyl\Http\Requests\Api\Client\GetServersRequest;
use Pterodactyl\Http\Controllers\Api\Client\ClientApiController;
use Pterodactyl\Models\Bagoulicense;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Pterodactyl\Repositories\Wings\DaemonFileRepository;
use Pterodactyl\Facades\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class ModsController extends ClientApiController
{
        /**
     * @var \Pterodactyl\Repositories\Wings\DaemonFileRepository
     */
    private $fileRepository;


    /**
     * FileController constructor.
     */
    public function __construct(
        DaemonFileRepository $fileRepository
    ) {
        parent::__construct();

        $this->fileRepository = $fileRepository;
    }
    /**
         * @throws DisplayException
         */
        public function curse(Request $request)
        {
            $license = Bagoulicense::where('addon', '257')->first();
            if(!$license) {
                return new BadRequestHttpException('No license for this addons please setup the license trough admin tab.');
            }
            $license = $license['license'];

            return Http::accept('application/json')->get('https://api.bagou450.com/api/client/pterodactyl/mods', ['page' => $request->page, 'search' => $request->search, 'id' => $license, 'type' => $request->type, 'game_versions' => $request->version, 'loaders' => $request->loader]);

        }

        public function versions(Request $request)
        {
            $license = Bagoulicense::where('addon', '257')->first();
            if(!$license) {
                return new BadRequestHttpException('No license for this addons please setup the license trough admin tab.');
            }
            $license = $license['license'];
            
            return Http::accept('application/json')->get('https://api.bagou450.com/api/client/pterodactyl/mods/versions', ['modId' => $request->modId, 'page' => $request->page, 'id' => $license, 'type' => $request->type]);
        }

        public function description(Request $request)
        {
            $license = Bagoulicense::where('addon', '257')->first();
            if(!$license) {
                return new BadRequestHttpException('No license for this addons please setup the license trough admin tab.');
            }
            $license = $license['license'];

            return Http::accept('application/json')->get('https://api.bagou450.com/api/client/pterodactyl/mods/description', ['modId' => $request->modId, 'id' => $license, 'type' => $request->type]);
        }

        public function mcversions(Request $request)
        {
            $license = Bagoulicense::where('addon', '257')->first();
            if(!$license) {
                return new BadRequestHttpException('No license for this addons please setup the license trough admin tab.');
            }
            $license = $license['license'];

            return Http::accept('application/json')->get('https://api.bagou450.com/api/client/pterodactyl/mods/getMcVersions', ['id' => $license]);
        }
        public function install(Request $request, Server $server)
    {
        Log::info('Received a new mod installation request', ['url' => $request->url]);

        $url = $request->url; // directly take URL from the request

        // Send a GET request to the URL
        $response = Http::get($url);

        // Check for a successful response
        if ($response->successful()) {
            // Extract the filename from the Content-Disposition header, if present
            $contentDisposition = $response->header('Content-Disposition');
            $filename = null;

            if ($contentDisposition) {
                $filename = $this->extractFilenameFromContentDisposition($contentDisposition);
            }

            // If we couldn't determine a filename, log an error and return
            if (!$filename) {
                Log::error('Could not determine filename from Content-Disposition', ['url' => $url]);
                return response()->json(['error' => 'Could not determine filename for download'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            Log::info('File downloaded successfully', ['url' => $url, 'filename' => $filename]);

            // Save the file to the mods directory
            $this->fileRepository->setServer($server)->putContent("Mods/$filename", $response->body());

            // Log the activity
            Activity::event('server:file.pull')
                ->property('directory', $request->input('directory'))
                ->property('url', $url) // log the final URL used for download
                ->log();

            Log::info('File saved to mods directory', ['file' => $filename]);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } else {
            // The request failed; handle the error
            Log::error('Failed to download file', ['url' => $url, 'status' => $response->status()]);
            return response()->json(['error' => 'Failed to download file'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function extractFilenameFromContentDisposition(string $contentDisposition): ?string
    {
        $filenameMatch = [];
        preg_match('/filename="?([^"]+)"?/', $contentDisposition, $filenameMatch); // adjusted regex

        return $filenameMatch[1] ?? null;
    }
}