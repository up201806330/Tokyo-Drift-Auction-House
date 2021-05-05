/**
 * @brief REST API interface class.
 * 
 * Provides an interface to a REST API.
 */
class RestApi {
    /**
     * Construct from API URL.
     * 
     * @param {String} server_url URL of API
     */
    constructor(api_url){
        this._api_url = api_url;
        if(this._api_url !== "" && this._api_url[this._api_url.length-1] !== '/')
            this._api_url += '/';
    }

    /**
     * Get URL to access a certain resource from its URI.
     * 
     * @param {String} uri URI of resource
     */
    _url_from_uri(uri){
        return `${this._api_url}${uri}`;
    }

    /**
     * Get resource.
     * 
     * @param {String} uri URI
     */
    get(uri){
        return fetch(
            this._url_from_uri(uri),
            {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
            }
        );
    }

    /**
     * Check if resource exists.
     * 
     * @param {String} uri URI
     */
    head(uri){
        return fetch(
            this._url_from_uri(uri),
            {
                method: 'HEAD',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
            }
        );
    }
    
    /**
     * Perform operation.
     * 
     * @param {String} uri URI
     * @param {Object} params Operation parameters
     */
    post(uri, params){
        let data = JSON.stringify(params);
        return fetch(
            this._url_from_uri(uri),
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                },
                body: data
            }
        );
    }
    
    /**
     * Create resource.
     * 
     * @param {String} uri URI
     * @param {Object} params New resource parameters
     */
    put(uri, params){
        let data;
        let headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
        };
        if(!(params instanceof File)){
            console.log("Sending JSON data");
            data = JSON.stringify(params);
            headers['Content-Type'] = 'application/json';
        } else {
            console.log("Sending file");
            data = params;
        }
        return fetch(
            this._url_from_uri(uri),
            {
                method: 'PUT',
                headers: headers,
                body: data
            }
        );
    }
    
    /**
     * Delete resource.
     * 
     * @param {String} uri URI
     */
    delete(uri){
        return fetch(
            this._url_from_uri(uri),
            {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                }
            }
        );
    }
};
