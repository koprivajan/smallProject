<template>
  <div>
    <div class="row col">
      <h1>Portal</h1>
    </div>




    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Login</th>
          <th>Email</th>
          <th>Role</th>
          <th>Password</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="post in posts"
          :key="post.id"
        >
          <td>{{ post.login }}</td>
          <td>{{ post.email }}</td>
          <td>{{ post.roles }}</td>
          <td>{{ post.password }}</td>
        </tr>
      </tbody>
    </table>
    
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

    <div
      v-else-if="!hasPosts"
      class="row col"
    >
      No posts!
    </div>
  </div>
</template>

<script>

import ErrorMessage from "../components/ErrorMessage";

export default {
  name: "Posts",
  components: {
    
    ErrorMessage
  },
  data() {
    return {
      message: ""
    };
  },
  computed: {
    isLoading() {
      return this.$store.getters["post/isLoading"];
    },
    hasError() {
      return this.$store.getters["post/hasError"];
    },
    error() {
      return this.$store.getters["post/error"];
    },
    hasPosts() {
      return this.$store.getters["post/hasPosts"];
    },
    posts() {
      return this.$store.getters["post/posts"];
    }

  },
  created() {
    this.$store.dispatch("post/findAll");
  },
  methods: {

  }
};
</script>
