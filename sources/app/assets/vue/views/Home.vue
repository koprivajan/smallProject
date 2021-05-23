<template>
  <div>
    <div class="row col">
      <h1>Register</h1>
    </div>

    <div class="row col">
      <form>
        <div class="form-row">
          <div class="col-4">
            <span>Login:</span>
            <input
              v-model="login"
              type="text"
              class="form-control"
            >
          </div>

          <div class="w-100" />

          <div class="col-4">
            <span>Password:</span>
            <input
              v-model="password"
              type="password"
              class="form-control"
            >
          </div>

          <div class="w-100" />

          <div class="col-4">
            <span>Email:</span>
            <input
              v-model="email"
              type="text"
              class="form-control"
            >
          </div>

          <div class="w-100" />

          <div class="col-4">
            <span>Role:</span>
            <div
              id="v-model-select"
              class="form-control"
            >
              <select v-model="role">
                <option value="admin">
                  Admin
                </option>
                <option value="user">
                  User
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="w-100" />

        <div class="col-4">
          <button
            :disabled="
              login.length === 0 ||
                password.length === 0 ||
                email.length === 0 ||
                role.length === 0 ||
                isLoading
            "
            type="button"
            class="btn btn-primary"
            @click="performRegister()"
          >
            Register
          </button>
        </div>
      </form>
    </div>

    <div
      v-if="isLoading"
      class="row col"
    >
      <p>Loading...</p>
    </div>

    <div
      v-else-if="hasError"
      class="row col"
    >
      <error-message :error="error" />
    </div>

    <div class="row col">
      <p><a>Please log in to PORTAL</a></p>
    </div>
  </div>
</template>

<script>
import ErrorMessage from "../components/ErrorMessage";

export default {
  name: "Home",
  components: {
    ErrorMessage
  },

  data() {
    return {
      login: "",
      password: "",
      role: "",
      email: ""
    };
  },
  computed: {
    isLoading() {
      return this.$store.getters["security/isLoading"];
    },
    hasError() {
      return this.$store.getters["security/hasError"];
    },
    error() {
      return this.$store.getters["security/error"];
    }
  },
  methods: {
    async performRegister() {
      let payload = {
        login: this.$data.login,
        password: this.$data.password,
        email: this.$data.email,
        role: this.$data.role
      };

      const result = await this.$store.dispatch("security/register", payload);
      if (result !== null) {
        this.$router.push("logout");
        location.reload();
      }
    }
  }
};
</script>
