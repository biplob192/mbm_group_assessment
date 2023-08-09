import Api, { http } from "./Api";
const END_POINT = "requisitions";

export default {
  store(data) {
    // return Api.post(END_POINT, data);
    return http().post(END_POINT, data);
  },

  show(id) {
    return http().get(`${END_POINT}/${id}`);
  },

  all() {
    return http().get(END_POINT);
  },

  update() {
    return http().put(`${END_POINT}/${id}`);
  },

  delete() {
    return http().delete(`${END_POINT}/${id}`);
  },

  approve(id) {
    return http().put(`${END_POINT}/approve/${id}`);
  },
  
  reject(id) {
    return http().put(`${END_POINT}/reject/${id}`);
  },
  
  issue(data) {
    return http().post(`issue_items`, data);
  },
};
