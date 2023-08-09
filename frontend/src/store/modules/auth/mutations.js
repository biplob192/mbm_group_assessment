export const SET_LOGIN_INFO = (state, response) => {
  let root = response.rootState;
  let user = response.data.data;
  let accessToken = response.data.data.access_token;
  let refreshToken = response.data.data.refresh_token;
  let role = response.data.data.roles['0'].name;

  root.logged_in = true;
  root.access_token = accessToken;
  root.refresh_token = refreshToken;
  root.user_role = role;
  root.user_info = JSON.stringify(user);
  state.user_info = JSON.stringify(user);
  state.login_response = JSON.stringify(response.data);

  localStorage.setItem("access_token", accessToken);
  localStorage.setItem("refresh_token", refreshToken);
  localStorage.setItem("user_role", role);
  localStorage.setItem("user_info", JSON.stringify(user));
};

export const SET_TOKEN = (state, response) => {
  let root = response.rootState;
  let accessToken = response.access_token;

  root.logged_in = true;
  root.access_token = accessToken;
  state.access_token = accessToken;

  localStorage.setItem("access_token", accessToken);
  root.user_info = JSON.parse(localStorage.getItem("user_info"));
  root.user_role = localStorage.getItem("user_role");
};
