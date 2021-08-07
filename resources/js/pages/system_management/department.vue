<template>
  <div>
    <div class="row">
      <div class="col-12">
        <h5>
          {{ this.$t("system_management") + " / " + this.$t("department") }}
        </h5>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-4">
        <input
          v-model="filterName"
          type="text"
          class="form-control"
          id="in_name"
          :placeholder="$t('name')"
        />
      </div>
      <div class="col-5">
        <button type="button" class="btn btn-primary" @click="Filter">
          {{ $t("filter") }}
        </button>
      </div>
      <div class="col-3">
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#myModal"
          @click="ShowMyModal(0)"
        >
          {{ $t("add_new") }}
        </button>
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
              {{ modalTitle }}
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
              <div class="col-12">
                <input
                  v-model="modalData.name"
                  type="text"
                  class="form-control"
                  id="in_name"
                  :placeholder="$t('name')"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
              @click="HideMyModal"
            >
              {{ $t("cancel") }}
            </button>
            <button
              type="button"
              id="add_button"
              class="btn btn-primary"
              @click="AddDepartment"
            >
              {{ $t("add_new") }}
            </button>
            <button
              type="button"
              id="update_button"
              class="btn btn-primary"
              @click="UpdateDepartment"
            >
              {{ $t("update") }}
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
              {{ $t("delete") + " " + $t("department") }}
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
    <div class="row">
      <div class="col-12">
        <b-table striped hover :fields="fields" :items="items">
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
              @click="ShowMyModal(row)"
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
              @click="DeleteDepartment(row.value)"
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
  </div>
</template>

<script>
import axios from "axios";
import $ from "jquery";
import Vue from "vue";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
Vue.use(VueToast);
import { BTable } from "bootstrap-vue";
Vue.component("b-table", BTable);

export default {
  middleware: "auth",
  metaInfo() {
    return { title: this.$t("department") };
  },
  data() {
    return {
      filterName: "",
      modalTitle: "",
      selectedDepartmentId: 0,
      nameFlag: 0,
      modalData: {
        name: "",
      },
      items: [],
      fields: [
        {
          key: "name",
          label: this.$t("department"),
        },
        {
          key: "id",
          label: "",
        },
      ],
    };
  },
  mounted() {
    this.GetData();
  },
  methods: {
    InitailData() {
      this.filterName = "";
      this.modalTitle = "";
      this.selectedDepartmentId = 0;
      this.nameFlag = 0;
    },
    GetData() {
      axios({
        url: `/api/department/getdata`,
        method: "get",
      })
        .then((response) => {
          if (response.data != []) {
            this.items = response.data;
          } else {
            this.items = [];
          }
          this.InitailData();
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
    Filter() {
      if (this.filterName == "") {
        this.GetData();
      } else {
        axios({
          url: `/api/department/filterdata/${this.filterName}`,
          method: "get",
        })
          .then((response) => {
            if (response.data != []) {
              this.items = response.data;
            } else {
              this.items = [];
            }
            if (response.data.length == 0) {
              Vue.$toast.open({
                message: this.$t("no_result"),
                type: "error",
              });
            }
            this.InitailData();
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    ShowMyModal(index) {
      if (index == 0) {
        this.modalData.name = "";
        this.modalTitle = this.$t("add_new");
        $("#update_button").hide(0);
        $("#add_button").show(0);
        this.selectedDepartmentId = index;
      } else {
        this.modalData.name = index.item.name;
        this.modalTitle = this.$t("update") + " " + this.$t("department");
        $("#add_button").hide(0);
        $("#update_button").show(0);
        this.selectedDepartmentId = index.item.id;
      }
    },
    HideMyModal() {
      this.modalData.name = "";
    },
    VaildateField() {
      if (this.modalData.name == "") {
        Vue.$toast.open({
          message: this.$t("name") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.nameFlag = 1;
      }
    },
    AddDepartment() {
      this.VaildateField();

      if (this.nameFlag == 1) {
        axios({
          url: `/api/department/create`,
          method: "post",
          data: this.modalData,
        })
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
            this.GetData();
            this.HideMyModal();
            $("#myModal").modal("hide");
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    UpdateDepartment() {
      this.VaildateField();

      if (this.nameFlag == 1) {
        axios({
          url: `/api/department/update/${this.selectedDepartmentId}`,
          method: "post",
          data: this.modalData,
        })
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
            this.GetData();
            this.HideMyModal();
            $("#myModal").modal("hide");
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    DeleteDepartment(index) {
      this.selectedDepartmentId = index;
    },
    ConfirmDelete() {
      axios({
        url: `/api/department/delete/${this.selectedDepartmentId}`,
        method: "post",
      })
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
          this.GetData();
          $("#deleteModal").modal("hide");
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.margin-rignt {
  margin-right: 20px;
}

.cursor {
  cursor: pointer;
}
</style>