import http from "k6/http";
import { sleep, check } from "k6";

const searchEndpointUrl = 'http://localhost:8000/api/search?name=Mark';

export const options = {
    scenarios: {
        stress: {
            executor: "ramping-arrival-rate",
            preAllocatedVUs: 500,
            timeUnit: "1s",
            stages: [
                { duration: "2m", target: 10 }, // below normal load
                { duration: "5m", target: 10 },
                { duration: "2m", target: 20 }, // normal load
                // { duration: "5m", target: 20 },
                // { duration: "2m", target: 30 }, // around the breaking point
                // { duration: "5m", target: 30 },
                // { duration: "2m", target: 40 }, // beyond the breaking point
                // { duration: "5m", target: 40 },
                // { duration: "10m", target: 0 }, // scale down. Recovery stage.
            ],
        },
    },
};
export default function () {
    const BASE_URL = "http://localhost:8000/api/"; // make sure this is not production
    const responses = http.batch([
        ["GET", `${BASE_URL}search?name=Mark`],
        ["GET", `${BASE_URL}search?name=Jaron`],
        ["GET", `${BASE_URL}search?name=Marcelino`],
        ["GET", `${BASE_URL}search?name=Estel`],
    ]);
}
