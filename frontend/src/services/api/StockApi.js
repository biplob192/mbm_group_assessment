import Api, { http } from "./Api";
const END_POINT = "stocks";

export default {
  all() {
    return http().get(END_POINT);
  },
};
