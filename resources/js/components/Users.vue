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
                      <a href="#">
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
            <h5 class="modal-title" id="userModalTitle">Modal Title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form
            id="userForm"
        
          >
            <div class="modal-body">
              <!-- Name -->
              <div class="form-group">
                <input
                  
                  type="text"
                  name="name"
                  placeholder="Name"
                  class="form-control"
                  
                >
                <!-- <has-error :form="form" field="name"></has-error> -->
              </div>

              <!-- Mobile -->
              <div class="form-group">
                <input
                  
                  type="tel"
                  name="mobile"
                  placeholder="Mobile"
                  class="form-control"
                  
                >
                <!-- <has-error :form="form" field="mobile"></has-error> -->
              </div>

              <!-- Email -->
              <div class="form-group">
                <input
                  
                  type="email"
                  name="email"
                  placeholder="Email"
                  class="form-control"
                  
                >
                <!-- <has-error :form="form" field="email"></has-error> -->
              </div>

              <!-- Member Type -->
              <div class="form-group">
                <select
                  
                  name="type"
                  id="type"
                  class="form-control"
                
                >
                  <option disabled value>Please select member type</option>
                  <option value="admin">Admin</option>
                  <option value="member">member</option>
                  <option value="staff">Staff</option>
                  <option value="trainer">Trainer</option>
                  <option value="nutritionist">Nutritionist</option>
                </select>
                <!-- <has-error :form="form" field="type"></has-error> -->
              </div>

              <!-- Password -->
              <div class="form-group">
                <input
                  
                  name="password"
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  id="password"
                  
                >
                <!-- <has-error :form="form" field="password"></has-error> -->
              </div>

              <!-- Bio -->
              <div class="form-group">
                <textarea
                  
                  type="text"
                  name="bio"
                  placeholder="Bio"
                  class="form-control"
                  
                ></textarea>
                <!-- <has-error :form="form" field="bio"></has-error> -->
              </div>

              <!-- File Attachment -->
              <div class="form-group">
                <label for="memberProfilePicture">Member profile picture</label>
                <input
                  
                  name="photo"
                  type="file"
                  class="form-control-file"
                  id="memberProfilePicture"
                  
                >
                <!-- <has-error :form="form" field="photo"></has-error> -->
              </div>

              <!-- Accept Terms -->
              <div class="form-check">
                <input
                  
                  type="checkbox"
                  class="form-check-input"
                  id="agreeterms"
                >
                <label class="form-check-label" for="agreeterms">I agree terms and conditions.</label>
                <!-- <has-error :form="form" field="terms"></has-error> -->
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-warning">Reset</button>
              <button
                
                type="submit"
                class="btn btn-primary"
              >Modal Action</button>
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
    };
  },
  methods: {
    createUserModal() {
    
      $("#userModal").modal("show");
      this.modalTitle = "Add New User";
      this.modalAction = "Create";
      this.modalMode = true; // means onSubmit it will send CREATE request
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
