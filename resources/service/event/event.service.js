import axios from "axios";
import Config from "../../config/config";
var promise;

export default class EventService {

    list() {
        promise = axios.get(`${Config.api_prefix}/events`);
        return promise;
    }

    store(data) {
        promise = axios.post(`${Config.api_prefix}/events`, data);
        return promise;
        // promise = axios.get(`${Config.api_prefix}/events`);
        // return promise;
    }

    getDayList() {
        promise = axios.get(`${Config.api_prefix}/get-days`);
        return promise;
    }

}
