import axios from "axios";
window.axios = axios;
import phil from "philippine-location-json-for-geer";
window.phil = phil;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
