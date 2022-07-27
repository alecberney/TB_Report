import axios from "axios";
import updateToken from "/src/middleware/keycloakUpdateToken";

export const API_ROUTE = `${process.env.VUE_APP_ROOT_API}`;

axios.interceptors.request.use(async function (config) {
  const token = await updateToken();
  if (token !== null) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});
