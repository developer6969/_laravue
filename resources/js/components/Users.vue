<template>
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-12">
          <div class="card">
          
            <div class="card-header">
              <h3 class="card-title">Members Table</h3>
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
          
            <div class="card-body">
              <table id="table1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>First User</td>
                    <td>first@user.com</td>
                    <td>Admin</td>
                    <td>
                      <a href="#" @click="editUserModal">
                        <i class="fa fa-edit green"></i>
                      </a>
                      <span style="visibility: hidden">x</span>
                      <a href="#">
                        <i class="fa fa-trash red"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <p class="p-2">i m a table footer</p>
                </tfoot>
              </table>
            </div>
            
            <div class="card-footer">
              <h3 class="card-title">Card Footer</h3>
            </div>

        </div>
      </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div
      id="userModal"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="userModalTitle"
      aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="userModalTitle">{{ modalTitle }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- https://github.com/cretueusebiu/vform/blob/master/example/bootstrap4.html -->
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
              <button type="button" class="btn btn-warning">Reset</button>
              <button
                
                type="submit"
                class="btn btn-primary"
               >{{ modalAction }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
        terms: "",
        remember: false,
      })
    };
  },
  methods: {
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
            // Fire.$emit("reloadData");
            $("#userModal").modal("hide");
            // Toast.fire({
            //   type: "success",
            //   title: "User created successfully"
            // });
            // this.$Progress.finish();
          })
          .catch(() => {
            // this.$Progress.fail();
          });
      } else {
        // Swal.fire({
        //   title: "Unauthorized Action",
        //   text: "Contact your administrator to perform this action",
        //   type: "warning"
        // });
      }
    },
    editUser() {
      // if (this.$gate.isAdmin()) {
        if (this.editUserId > 0) {
          // this.$Progress.start();
          this.form
            .put("api/user/" + this.editUserId)
            .then(() => {
              // Fire.$emit("reloadData");
              $("#userModal").modal("hide");
              // Toast.fire({
              //   type: "success",
              //   title: "User updated successfully"
              // });
              this.editUserId = 0;
              // this.$Progress.finish();
            })
            .catch(() => {
              this.editUserId = 0;
              // this.$Progress.fail();
            });
        }
      // } else {
      //   Swal.fire({
      //     title: "Unauthorized Action",
      //     text: "Contact your administrator to perform this action",
      //     type: "warning"
      //   });
      // }
    },
  },
  created() {
    console.log("Component created.");
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
