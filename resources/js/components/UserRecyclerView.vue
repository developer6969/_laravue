<template>
  <div>
    <table class="table">
      <tbody class="recycler-view-table">
        <tr
          class="recycler-view-item"
          v-bind:class="getActiveItem(user.id)"
          v-for="user in users.data"
          :key="user.id"
          @click="viewUserDetail(user)"
        >
          <td>
            <tr>
              <td rowspan="2" id="c1">
                <img :src="userProfilePhoto(user.photo)" class="profile-image-thumb">
              </td>
              <td rowspan="1" id="c2r1">{{ user.name }}</td>
            </tr>
            <tr>
              <td rowspan="1" id="c2r2">{{ user.id }}</td>
            </tr>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: {}
    };
  },
  created() {
    console.log("Component created : URV");
    this.users = this.$parent.data.users.data;
    console.log("Component created : URV" + this.users);
  },
  mounted() {
    console.log("Component mounted : URV");
  }
};
</script>
