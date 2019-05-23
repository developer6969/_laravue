<template>
  <div>
    <!-- Error Page for Unauthorised Users -->
    <div v-show="!$gate.canAccessAllMember()">
      <unauthorized-access></unauthorized-access>
    </div>

    <!-- ONLY ADMIN HAS ACCESS TO THIS SECTION -->
    <div v-show="$gate.canAccessAllMember()">
      <div class="row pt-2">

        <!-- Members Recycler View  : Start (Left)-->
        <div class="col-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Members</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-secondary btn-sm" @click="createUserModal">
                  <i class="fas fa-sort-amount-down"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" @click="createUserModal">
                  <i class="fas fa-filter"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" @click="createUserModal">
                  <i class="fas fa-user-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table">
                <tbody class="recycler-view-table">
                  <tr
                    class="recycler-view-item"
                    v-bind:class="getActiveItem(user.id)"
                    v-for="user in users.data"
                    :key="user.id"
                    @click="viewUserDetail(user)"
                  >

                    <!-- Recycler View Item : Start -->
                    <td style="padding-right: 0 !important;">
                      <tr>
                        <td rowspan="2" id="c1">
                          <img :src="userProfilePhoto(user.photo)" class="profile-image-thumb">
                        </td>
                        <td rowspan="1" style="width: 180px;">{{ user.name }}</td>
                      </tr>
                      <tr>
                        <td rowspan="1" style="width: 140px;">{{ user.id }}</td>
                      </tr>
                    </td>
                    <!-- Recycler View Item : End -->

                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <pagination :data="users" @pagination-change-page="getResults"></pagination>
            </div>
          </div>
        </div>
        <!-- Members Recycler View  : End -->


        <!-- Selected Member Profile : Start-->
        <div class="col-9" v-if="showDetailUser">
          <div class="row">

            <!-- Member Details (Center) -->
            <div class="col-9">

              <div class="card card-widget widget-user">
                <div
                  class="widget-user-header text-white"
                  v-bind:style="{ backgroundColor: profileImageBackground }"
                >
                  <div class="row">
                    <div class="col-6">
                      <h5 class="widget-user-username">{{ auser.name }}</h5>
                      <h5 class="widget-user-desc">{{ auser.mobile }}</h5>
                    </div>
                    <div class="col-6" style="position: relative:">
                      <table style="position: absolute; right: 0;">
                        <tr>
                          <td>
                            <p class="img-circle img-sm bg-red">A</p>
                          </td>
                          <td>
                            <p class="img-circle img-sm bg-gold">Z</p>
                          </td>
                          <td>
                            <p class="img-circle img-sm bg-green">D</p>
                          </td>
                          <td>
                            <p class="img-circle img-sm bg-blue">E</p>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <a
                              href="#"
                              @click="editUserModal(auser)"
                              style="color: white; text-decoration: none;"
                            >
                              <span>
                                <i class="fa fa-edit pr-2"></i>Edit
                              </span>
                            </a>
                          </td>
                          <td colspan="2">
                            <a
                              href="#"
                              @click="editUserModal(auser)"
                              style="color: white; text-decoration: none;"
                            >
                              <span>
                                <i class="fa fa-trash-alt pr-2"></i>Delete
                              </span>
                            </a>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="widget-user-image">
                  <img
                    class="img-circle profile-image"
                    :src="getProfilePhoto()"
                    alt="User Avatar"
                  >
                  <p class="img-circle active"></p>
                </div>
                <div class="card-footer">
                  <div class="row">
                    
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Gold</h5>
                        <span class="description-text">Membership</span>
                      </div>
                    </div>
                    
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header"></h5>
                        <span class="description-text"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">35 weeks</h5>
                        <span class="description-text">Training</span>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-body table-responsive p-4">
                  <div>
                    <h3>Membership Details :</h3>
                    <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, dignissimos consectetur porro in voluptas ipsum autem consequatur ipsam fugit amet unde nostrum officiis consequuntur cupiditate esse animi aspernatur veniam quos!</div>
                  </div>
                  <hr>
                  <div>
                    <h3>Fees Details :</h3>
                    <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, dignissimos consectetur porro in voluptas ipsum autem consequatur ipsam fugit amet unde nostrum officiis consequuntur cupiditate esse animi aspernatur veniam quos!</div>
                  </div>
                  <hr>
                  <div>
                    <h3>Nutrition Details :</h3>
                    <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem, dignissimos consectetur porro in voluptas ipsum autem consequatur ipsam fugit amet unde nostrum officiis consequuntur cupiditate esse animi aspernatur veniam quos!</div>
                  </div>
                  <hr>
                </div>
                <div class="card-footer">
                  <p>Footer</p>
                </div>
              </div>

            </div>

            <!-- Member Statistics (Right) -->
            <div class="col-3">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info
                  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>150</h3>

                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info
                  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>150</h3>

                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info
                  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              <div class="small-box bg-gold">
                <div class="inner">
                  <h3>150</h3>

                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info
                  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
        <!-- Selected Member Profile : End -->

      </div>
    
      <!-- Add/Edit User Modal -->
      <div
        id="userModal"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="userModalTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userModalTitle">{{ modalTitle }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form
              id="userForm"
              @submit.prevent="modalMode ? createUser() : editUser()"
              @keydown="form.onKeydown($event)"
            >
              <div class="modal-body">
                <!-- Name -->
                <div class="form-group">
                  <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    placeholder="Name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  >
                  <has-error :form="form" field="name"></has-error>
                </div>

                <!-- Mobile -->
                <div class="form-group">
                  <input
                    v-model="form.mobile"
                    type="tel"
                    name="mobile"
                    placeholder="Mobile"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('mobile') }"
                  >
                  <has-error :form="form" field="mobile"></has-error>
                </div>

                <!-- Email -->
                <div class="form-group">
                  <input
                    v-model="form.email"
                    type="email"
                    name="email"
                    placeholder="Email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                  >
                  <has-error :form="form" field="email"></has-error>
                </div>

                <!-- Member Type -->
                <div class="form-group">
                  <select
                    v-model="form.type"
                    name="type"
                    id="type"
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('type')}"
                  >
                    <option disabled value>Please select member type</option>
                    <option value="admin">Admin</option>
                    <option value="member">member</option>
                    <option value="staff">Staff</option>
                    <option value="trainer">Trainer</option>
                    <option value="nutritionist">Nutritionist</option>
                  </select>
                  <has-error :form="form" field="type"></has-error>
                </div>

                <!-- Password -->
                <div class="form-group">
                  <input
                    v-model="form.password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    id="password"
                    :class="{'is-invalid': form.errors.has('password')}"
                  >
                  <has-error :form="form" field="password"></has-error>
                </div>

                <!-- Bio -->
                <div class="form-group">
                  <textarea
                    v-model="form.bio"
                    type="text"
                    name="bio"
                    placeholder="Bio"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('bio') }"
                  ></textarea>
                  <has-error :form="form" field="bio"></has-error>
                </div>

                <!-- File Attachment -->
                <div class="form-group">
                  <label for="memberProfilePicture">Member profile picture</label>
                  <input
                    @change="processFile($event)"
                    name="photo"
                    type="file"
                    class="form-control-file"
                    id="memberProfilePicture"
                    :class="{ 'is-invalid': form.errors.has('photo') }"
                  >
                  <has-error :form="form" field="photo"></has-error>
                </div>

                <!-- Accept Terms -->
                <div class="form-check">
                  <input
                    v-model="form.terms"
                    type="checkbox"
                    class="form-check-input"
                    id="agreeterms"
                  >
                  <label class="form-check-label" for="agreeterms">I agree terms and conditions.</label>
                  <has-error :form="form" field="terms"></has-error>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-warning" @click="resetForm">Reset</button>
                <button
                  :disabled="form.busy"
                  type="submit"
                  class="btn btn-primary"
                >{{ modalAction }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
    <!-- ADMIN SECTION : End -->

  </div>
</template>

<script>
export default {
  data() {
    return {
      modalMode: true,
      modalTitle: "",
      modalAction: "",
      editUserId: 0,
      users: {},
      auser: {},
      showDetailUser: false,
      activeItemId: 0,
      profileImageBackground: "#8e8e8e",
      form: new Form({
        name: "",
        mobile: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: "",
        terms: ""
      })
    };
  },
  methods: {
    loadUser() {
      if (this.$gate.canAccessAllMember()) {
        axios.get("api/user").then(({ data }) => (this.users = data));
      }
    },
    createUserModal() {
      this.form.reset();
      $("#userModal").modal("show");
      this.modalTitle = "Add New User";
      this.modalAction = "Create";
      this.modalMode = true; // means onSubmit it will send CREATE request
    },
    editUserModal(user) {
      $("#userModal").modal("show");
      this.modalTitle = "Edit User";
      this.modalAction = "Update";
      this.form.fill(user);
      this.editUserId = user.id;
      this.modalMode = false; // means onSubmit it will send UPDATE request
    },
    createUser() {
      if (this.$gate.isAdmin()) {
        this.$Progress.start();
        this.form
          .post("api/user")
          .then(() => {
            Fire.$emit("reloadData");
            $("#userModal").modal("hide");
            Toast.fire({
              type: "success",
              title: "User created successfully"
            });
            this.$Progress.finish();
          })
          .catch(() => {
            this.$Progress.fail();
          });
      } else {
        Swal.fire({
          title: "Unauthorized Action",
          text: "Contact your administrator to perform this action",
          type: "warning"
        });
      }
    },
    editUser() {
      if (this.$gate.isAdmin()) {
        if (this.editUserId > 0) {
          this.$Progress.start();
          this.form
            .put("api/user/" + this.editUserId)
            .then(() => {
              Fire.$emit("reloadData");
              $("#userModal").modal("hide");
              Toast.fire({
                type: "success",
                title: "User updated successfully"
              });
              this.editUserId = 0;
              this.$Progress.finish();
            })
            .catch(() => {
              this.editUserId = 0;
              this.$Progress.fail();
            });
        }
      } else {
        Swal.fire({
          title: "Unauthorized Action",
          text: "Contact your administrator to perform this action",
          type: "warning"
        });
      }
    },
    deleteUser(userId) {
      if (this.$gate.isAdmin()) {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then(result => {
          if (result.value) {
            // Send request to server
            this.form.delete("api/user/" + userId).then(() => {
              Fire.$emit("reloadData");
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
          }
        });
      } else {
        Swal.fire({
          title: "Unauthorized Action",
          text: "Contact your administrator to perform this action",
          type: "warning"
        });
      }
    },
    resetForm() {
      this.form.reset();
    },
    processFile(event) {
      this.photo = event.target.files[0];
    },
    getResults(page = 1) {
      // Our method to GET results from a Laravel endpoint
      axios.get("api/user?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    viewUserDetail(clickedUser) {
      //alert("Clicked " + clickedUser.name);
      this.showDetailUser = true;
      this.auser = clickedUser;
      this.activeItemId = clickedUser.id;
    },
    getProfilePhoto() {
      if (this.showDetailUser) {
        if(this.auser.photo != null) {
          return this.auser.photo.length > 200
            ? this.auser.photo
            : "img/profile/" + this.auser.photo;
        } else {
          return "img/profile/default.png";
        }
      } else {
        return "";
      }
    },
    userProfilePhoto(photo) {
      if(photo == null) {
        return "img/profile/default.png";
      } else {
        return "img/profile/" + photo;
      }
    },
    getActiveItem(clickedUserId) {
      if (this.activeItemId === clickedUserId) {
        return "activeItem";
      }
    }
  },
  created() {
    this.$Progress.start();
    this.loadUser();
    Fire.$on("reloadData", () => {
      this.loadUser();
    });
    Fire.$on("searching", () => {
      let query = this.$parent.search;
      axios
        .get("api/findUser?q=" + query)
        .then(data => {
          this.users = data.data;
        })
        .catch(() => {});
    });
  },
  mounted() {
    console.log("Component mounted.");
    this.$Progress.finish();
  }
};
</script>

<style scoped>
.pl-4,
.card-body.p-0 .table thead > tr > th:first-of-type,
.card-body.p-0 .table thead > tr > td:first-of-type,
.card-body.p-0 .table tbody > tr > th:first-of-type,
.card-body.p-0 .table tbody > tr > td:first-of-type,
.px-4 {
  padding-left: 0 !important;
}

.table .recycler-view-table th,
.table .recycler-view-table td {
  padding: 0 !important;
  border: 0 !important;
}

.table .recycler-view-table td:hover {
  background-color: #ededed;
}

.recycler-view-item {
  /* background-color: red !important; */
  border-bottom: 1px solid #b2b2b2;
}

.profile-image-thumb {
  width: 50px;
  height: 50px;
  margin: 4px;
}

.widget-user {
  margin-top: 20px !important;
}

/* .widget-user .widget-user-image {
  position: relative;
} */

.widget-user .widget-user-image > img {
  width: 140px !important;
  margin-top: -40px;
  margin-left: -25px;
}

.widget-user .widget-user-header {
  padding: 20px !important;
}

.widget-user .widget-user-username {
  line-height: 35px;
  overflow: hidden;
  font-size: 35px;
  font-variant-caps: all-petite-caps;
}

.profile-image {
  /* width: 150px !important; */
  /* height: 60%; */
  /* margin-left: -4px; */
  /* margin-right: 12px; */
  /* border: 2px solid #fff; */
  /* border-radius: 4px; */
  /* padding: 3px;
  background: linear-gradient(to right, green, purple); */
}

/* #c1 {
    background-color: red;
} */

.profile-header {
  height: 160px;
  padding-top: 10px;
  padding-left: 15px;
  background-image: linear-gradient(
    to bottom right,
    rgba(255, 217, 0, 0.8),
    rgba(255, 166, 0, 0.8)
  );
}

.profile-name {
  font-variant: small-caps;
  font-size: 1.2rem;
}

.profile-email,
.profile-mobile,
.profile-id {
  font-size: 1rem;
  font-weight: 100;
}

.nav-item {
  min-width: 80px !important;
}
.nav-tabs {
  margin-top: 57px;
}

.activeItem {
  background-image: linear-gradient(
    to bottom right,
    rgba(255, 217, 0, 0.5),
    rgba(255, 166, 0, 0.5)
  );
  /* background-image: linear-gradient(
    to right,
    rgba(255, 0, 0, 0),
    rgb(206, 179, 24)
  ); */
}

.card-title {
  z-index: 200;
}

.card-footer {
  padding: 0;
}

.img-circle {
  font-size: 18px;
  text-align: center;
  font-weight: 600;
}

.active {
  width: 20px;
  height: 20px;
  background-color: green;
  position: absolute;
  right: 0;
  margin-top: -25px;
  margin-left: -20px;
}

.bg-red {
  background-image: linear-gradient(
    to bottom right,
    rgb(255, 0, 0),
    rgb(255, 71, 71)
  );
}

.bg-gold {
  background-image: linear-gradient(
    to bottom right,
    rgb(160, 0, 150),
    rgb(179, 44, 170)
  );
}

.bg-green {
  background-image: linear-gradient(
    to bottom right,
    rgb(0, 160, 0),
    rgb(60, 180, 60)
  );
}

.bg-blue {
  background-image: linear-gradient(
    to bottom right,
    rgb(0, 80, 255),
    rgb(35, 105, 255)
  );
}
</style>