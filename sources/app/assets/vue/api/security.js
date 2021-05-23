import axios from "axios";

export default {
  login(login, password) {
    return axios.post("/api/security/login", {
      username: login,
      password: password
    });
  },
  
  register(login, password, role, email) {
    return axios.post("/api/security/register", {
      login: login,
      password: password,
      role: role,
      email: email
    });
  }
  
  
  
}
