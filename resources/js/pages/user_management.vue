<template>
<div>
    <div class="row">
      <div class="col-6 col-sm-4 col-md-2">
        <input
          type="text"
          class="form-control"
          v-model="filterUsername"
          :placeholder="$t('username')"
        /> 
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <input
          type="text"
          class="form-control"
          v-model="filterEmail"
          :placeholder="$t('email')"
        />
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-primary" @click="handleFilter">
          {{ $t("filter") }}
        </button>
      </div>
      <div class="col-3 right-side">
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#addNewModal"
          @click="ShowAddNewModal"
        >
          {{ $t("add_new") }}
        </button>
      </div>
    </div>
    <br />
    <card :title="$t('users')">
      <div class="row">
        <div class="col-12">
          <b-table striped hover :fields="fields" :items="tabledata">
            <template #cell(no)="row">
              {{row.index + 1}}
            </template>
            <template #cell(role)="row">
              <input type="checkbox" :checked="Number(row.value)" @click="setRoleActive($event, row.item.id)">
              {{ $t("admin") }}
            </template>
            <template #cell(permission)="row">
              <input type="checkbox" :checked="Number(row.value)" @click="setPermissionActive($event, row.item.id)">
              {{ $t("allow") }}
            </template>
            <template #cell(id)="row">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="currentColor"
                class="bi bi-pencil margin-rignt cursor"
                viewBox="0 0 16 16"
                data-toggle="modal"
                data-target="#myModal"
                @click="ShowUpdateModal(row)"
              >
                <path
                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"
                />
              </svg>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="currentColor"
                class="bi bi-trash cursor"
                viewBox="0 0 16 16"
                data-toggle="modal"
                data-target="#deleteModal"
                @click="DeleteUser(row.value)"
              >
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                />
                <path
                  fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                />
              </svg>
            </template>
          </b-table>
        </div>
      </div>

      <!-- Modal -->
      <div
        class="modal fade"
        id="myModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">
                {{ $t("update_user") }}
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <input
                    v-model="updateModalData.username"
                    type="text"
                    class="form-control"
                    id="in_username"
                    :placeholder="$t('username')"
                  />
                </div>
                <div class="col-6">
                  <input
                    v-model="updateModalData.email"
                    type="text"
                    class="form-control"
                    id="in_email"
                    :placeholder="$t('email')"
                    maxlength="30"
                  />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                id="update_button"
                class="btn btn-primary"
                @click="UpdateUser"
              >
                {{ $t("update") }}
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="HideUpdateModal"
              >
                {{ $t("cancel") }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div
        class="modal fade"
        id="addNewModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addNewModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addNewModalLabel">
                {{$t('add_new')}}
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <input
                    v-model="addNewModalData.username"
                    type="text"
                    class="form-control"
                    id="in_username"
                    :placeholder="$t('username')"
                  />
                </div>
                <div class="col-6">
                  <input
                    v-model="addNewModalData.firstname"
                    type="text"
                    class="form-control"
                    id="in_firstname"
                    :placeholder="$t('firstname')"
                    maxlength="30"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <input
                    v-model="addNewModalData.lastname"
                    type="text"
                    class="form-control"
                    id="in_lastname"
                    :placeholder="$t('lastname')"
                  />
                </div>
                <div class="col-6">
                  <input
                    v-model="addNewModalData.email"
                    type="text"
                    class="form-control"
                    id="in_email"
                    :placeholder="$t('email')"
                    maxlength="30"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <input
                    v-model="addNewModalData.password"
                    type="text"
                    class="form-control"
                    id="in_password"
                    :placeholder="$t('password')"
                  />
                </div>
                <div class="col-6">
                  <input
                    v-model="addNewModalData.confirm"
                    type="text"
                    class="form-control"
                    id="in_confirm"
                    :placeholder="$t('confirm_password')"
                  />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                id="add_button"
                class="btn btn-primary"
                @click="AddUser"
              >
                {{ $t("add_new") }}
              </button>
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="HideAddNewModal"
              >
                {{ $t("cancel") }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div
        class="modal fade"
        id="deleteModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="deleteModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">
                {{ $t("delete") + " " + $t("user") }}
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">{{ $t("sure") }}</div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                {{ $t("cancel") }}
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="ConfirmDelete"
              >
                {{ $t("delete") }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <br />
    </card>
  </div>
</template>

<script>
import Vue from 'vue';
import axios from "axios";
import $ from "jquery";
import { data2query } from "~/helpers";

export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("user_management") };
  },

  data() {
    return ({
      fields: [
        {
          key: "no",
          label: "#",
          sortable: false,
        },
        {
          key: "username",
          label: this.$t("username"),
          sortable: true,
        },
        {
          key: "email",
          label: this.$t("email"),
          sortable: true,
        },
        {
          key: "role",
          label: this.$t("role"),
          sortable: true,
        },
        {
          key: "permission",
          label: this.$t("permission"),
          sortable: true,
        },
        {
          key: "id",
          label: "",
        },
      ],
      tabledata: [],
      filterUsername: "",
      filterEmail: "",
      selectedUserId: 0,
      validateFlag: 0,
      updateModalData: {
        id: "0",
        username: "",
        email: "",
      },
      addNewModalData: {
        username: "",
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        confirm: "",
      },
    });
  },

  mounted () {
    this.getAllUsers();
  },
  methods: {
    getAllUsers() {
      const { filterUsername, filterEmail } = this;
      axios.get('/api/users' + data2query({
        username: filterUsername,
        email: filterEmail
      }))
        .then(res => {
          const { data } = res;
          if (data.length == 0) {
            Vue.$toast.open({
              message: this.$t("no_result"),
              type: "error",
            });
          } 
          console.log(data);
          this.tabledata = data.users;
        })
        .catch( error => {
          console.log(error);
        });
    },
    handleFilter() {
      this.getAllUsers();
    },
    ShowAddNewModal() {
      this.validateFlag = 0;
      this.updateModalData.username = "";
      this.updateModalData.firstname = "";
      this.updateModalData.lastname = "";
      this.updateModalData.email = "";
      this.updateModalData.password = "";
    },
    ShowUpdateModal(index) {
      this.validateFlag = 0;
      this.updateModalData.id = index.item.id;
      this.updateModalData.username = index.item.username;
      this.updateModalData.email = index.item.email;
      this.selectedUserId = index.item.id;
    },
    HideAddNewModal() {
      this.updateModalData.username = "";
      this.updateModalData.firstname = "";
      this.updateModalData.lastname = "";
      this.updateModalData.email = "";
      this.updateModalData.password = "";
    },    
    HideUpdateModal() {
      this.updateModalData.id = "";
      this.updateModalData.username = "";
      this.updateModalData.email = "";
    },    
    addNewVaildateField() {
      if (this.addNewModalData.username == "") {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("username") + this.$t("required_field"),
          type: "error",
        });
      } 

      if (this.addNewModalData.firstname == "") {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("firstname") + this.$t("required_field"),
          type: "error",
        });
      }

      if (this.addNewModalData.lastname == "") {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("lastname") + this.$t("required_field"),
          type: "error",
        });
      }

      if (this.addNewModalData.email == "") {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("email") + this.$t("required_field"),
          type: "error",
        });
      }

      if (this.addNewModalData.password == "" || this.addNewModalData.password != this.addNewModalData.confirm ) {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("confirm_password"),
          type: "error",
        });
      }
    },

    updateVaildateField() {
      if (this.updateModalData.username == "") {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("username") + this.$t("required_field"),
          type: "error",
        });
      }

      if (this.updateModalData.email == "") {
        this.validateFlag = 1;
        Vue.$toast.open({
          message: this.$t("email") + this.$t("required_field"),
          type: "error",
        });
      }
    },

    AddUser() {
      this.addNewVaildateField();
      if (this.validateFlag == 1) {
        axios.get('/api/users/create' + data2query(this.updateModalData))
          .then((response) => {
            if (response.data.error) {
              Vue.$toast.open({
                message: response.data.error,
                type: "error",
              });
            }
            Vue.$toast.open({
              message: this.$t("success"),
              type: "success",
            });
            this.getAllUsers();
            this.HideMyModal();
            $("#myModal").modal("hide");
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    UpdateUser() {
      this.updateVaildateField();

      if (this.validateFlag == 1 ) {
        axios.get('/api/users/update' + data2query(this.updateModalData))
          .then((response) => {
            if (response.data.error) {
              Vue.$toast.open({
                message: response.data.error,
                type: "error",
              });
            }
            Vue.$toast.open({
              message: this.$t("success"),
              type: "success",
            });
            this.getAllUsers();
            this.HideMyModal();
            $("#myModal").modal("hide");
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    DeleteUser(index) {
      this.selectedUserId = index;
    },
    ConfirmDelete() {
      axios.get('/api/users/delete' + data2query({ id: this.selectedUserId }))
        .then((response) => {
          if (response.data.error) {
            Vue.$toast.open({
              message: response.data.error,
              type: "error",
            });
          }
          Vue.$toast.open({
            message: this.$t("success"),
            type: "success",
          });
          this.getAllUsers();
          $("#deleteModal").modal("hide");
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
    setRoleActive(e, id) {
      console.log(id);
      let role = e.target.checked? 1 : 0;
      axios.get('/api/users/updateRole' + data2query({ role, id }))
        .then((response) => {
          if (response.data.error) {
            Vue.$toast.open({
              message: response.data.error,
              type: "error",
            });
          }
          Vue.$toast.open({
            message: this.$t("success"),
            type: "success",
          });
          this.getAllUsers();
          $("#deleteModal").modal("hide");
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    setPermissionActive(e, id) {
      console.log(id);
      let permission = e.target.checked? 1 : 0;
      axios.get('/api/users/updatePermission' + data2query({ permission, id }))
        .then((response) => {
          if (response.data.error) {
            Vue.$toast.open({
              message: response.data.error,
              type: "error",
            });
          }
          Vue.$toast.open({
            message: this.$t("success"),
            type: "success",
          });
          this.getAllUsers();
          $("#deleteModal").modal("hide");
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
  }
};
</script>
<style lang="scss" scoped>
.row {
  margin-top: 20px;
}
</style>