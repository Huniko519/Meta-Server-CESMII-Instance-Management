import http from "../http-common";
class OrganizationService {
  getAll() {
    return http.get("/organizations").then((response) => response.data);
  }
  get(id) {
    return http.get(`/organizations/${id}`).then((response) => response.data);
  }
  create(data) {
    return http.post("/organizations", data).then((response) => response.data);
  }
  update(id, data) {
    return http.put(`/organizations/${id}`, data).then((response) => response.data);
  }
  delete(id) {
    return http.delete(`/organizations/${id}`).then((response) => response.data);
  }
  deleteAll() {
    return http.delete(`/organizations`).then((response) => response.data);
  }
  findByKeyword(keyword) {
    return http.get(`/organizations?q=${keyword}`).then((response) => response.data);
  }
}
export default new OrganizationService();