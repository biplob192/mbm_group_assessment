import Api from "./Api";

export default {
  login(data) {
    return Api.post("login", data);
  },

  register(data) {
    return Api.post("register", data);
  },
};
