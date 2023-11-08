import http from '@/api/http';

export default (uuid: string, url: string) => {
  return new Promise<void>((resolve, reject) => {
    console.log(`Sending request to install mod: ${url} for server: ${uuid}`); // Log the initiation

    http
      .post(`/api/client/servers/${uuid}/mods/install`, {
        url
      })
      .then((response) => {
        console.log('Response received:', response); // Log the successful response
        resolve();
      })
      .catch((error) => {
        console.error('Error occurred during the request:', error); // Log errors
        reject(error);
      });
  });
};
