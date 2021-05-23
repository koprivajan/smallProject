<template>
  <div class="card w-100 mt-2">
    <div class="card-body">
      {{ login }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Post",
  props: {
    login: {
      type: String,
      required: true
    }
  }
};
</script>
