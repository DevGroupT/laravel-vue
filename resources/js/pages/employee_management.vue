<template>
  <div>
    <div class="row">
      <div class="col-9">
        <h5>
          {{ this.$t("employee_management") }}
        </h5>
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
    <br />
    <div class="row">
      <div class="col-3 padding-top">
        <input
          v-model="filterData.firstname"
          type="text"
          class="form-control"
          :placeholder="$t('firstname')"
        />
      </div>
      <div class="col-3 padding-top">
        <input
          v-model="filterData.lastname"
          type="text"
          class="form-control"
          :placeholder="$t('lastname')"
        />
      </div>
      <div class="col-3">
        <span class="sub-font-size">{{ $t("deaprtment") }}</span>
        <b-form-select
          v-model="filterData.department_id"
          :options="department_options"
          size="sm"
        ></b-form-select>
      </div>
      <div class="col-3 padding-top">
        <button type="button" class="btn btn-primary" @click="Filter">
          {{ $t("filter") }}
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
      <div class="modal-dialog modal-lg" role="document">
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
              <div class="col-4">
                <input
                  v-model="modalData.firstname"
                  type="text"
                  class="form-control"
                  :placeholder="$t('firstname')"
                />
              </div>
              <div class="col-4">
                <input
                  v-model="modalData.lastname"
                  type="text"
                  class="form-control"
                  :placeholder="$t('lastname')"
                />
              </div>
              <div class="col-4">
                <input
                  v-model="modalData.middlename"
                  type="text"
                  class="form-control"
                  :placeholder="$t('middle_name')"
                />
              </div>
            </div>
            <div class="row">
              <div class="col-4 padding-top">
                <input
                  v-model="modalData.address"
                  type="text"
                  class="form-control"
                  :placeholder="$t('address')"
                />
              </div>
              <div class="col-4">
                <span class="sub-font-size">{{ $t("department") }}</span>
                <b-form-select
                  v-model="modalData.department_id"
                  :options="department_options"
                  size="sm"
                ></b-form-select>
              </div>
              <div class="col-4">
                <span class="sub-font-size">{{ $t("city") }}</span>
                <b-form-select
                  v-model="modalData.city_id"
                  :options="city_options"
                  size="sm"
                ></b-form-select>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <span class="sub-font-size">{{ $t("state") }}</span>
                <b-form-select
                  v-model="modalData.state_id"
                  :options="state_options"
                  size="sm"
                ></b-form-select>
              </div>
              <div class="col-4">
                <span class="sub-font-size">{{ $t("country") }}</span>
                <b-form-select
                  v-model="modalData.country_id"
                  :options="country_options"
                  size="sm"
                ></b-form-select>
              </div>
              <div class="col-4 padding-top">
                <input
                  v-model="modalData.zip"
                  type="text"
                  class="form-control"
                  :placeholder="$t('zip')"
                />
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col-6">
                <span>{{ $t("birthday") + " : " }}</span>
                <input type="date" v-model="modalData.birthday" />
              </div>
              <div class="col-6">
                <span>{{ $t("date_hired") + " : " }}</span>
                <input type="date" v-model="modalData.date_hired" />
              </div>
            </div>
          </div>
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
              id="add_button"
              class="btn btn-primary"
              @click="AddEmployee"
            >
              {{ $t("add_new") }}
            </button>
            <button
              type="button"
              id="update_button"
              class="btn btn-primary"
              @click="UpdateEmployee"
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
              {{ $t("delete") + " " + $t("country") }}
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
        <b-table
          striped
          hover
          :fields="fields"
          :items="items"
          v-if="country_options"
        >
          <template #cell(department_id)="row">
            <div v-for="(department, index) in department_options" :key="index">
              <div v-if="department.value == row.value">
                {{ department.text }}
              </div>
            </div>
          </template>
          <template #cell(city_id)="row">
            <div v-for="(city, index) in city_options" :key="index">
              <div v-if="city.value == row.value">
                {{ city.text }}
              </div>
            </div>
          </template>
          <template #cell(state_id)="row">
            <div v-for="(state, index) in state_options" :key="index">
              <div v-if="state.value == row.value">
                {{ state.text }}
              </div>
            </div>
          </template>
          <template #cell(country_id)="row">
            <div v-for="(country, index) in country_options" :key="index">
              <div v-if="country.value == row.value">
                {{ country.text }}
              </div>
            </div>
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
              @click="DeleteEmployee(row.value)"
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
import { BTable, BFormSelect, BFormDatepicker } from "bootstrap-vue";
Vue.component("b-table", BTable);
Vue.component("b-form-select", BFormSelect);
Vue.component("b-form-datepicker", BFormDatepicker);

export default {
  middleware: "auth",
  metaInfo() {
    return { title: this.$t("employee") };
  },
  data() {
    return {
      modalTitle: "",
      selectedEmployeeId: 0,
      firstnameFlag: 0,
      lastnameFlag: 0,
      addressFlag: 0,
      departmentFlag: 0,
      cityFlag: 0,
      stateFlag: 0,
      countryFlag: 0,
      zipFlag: 0,
      department_options: [],
      city_options: [],
      state_options: [],
      country_options: [],
      filterData: {
        firstname: "",
        lastname: "",
        department_id: null,
      },
      modalData: {
        firstname: "",
        lastname: "",
        middlename: "",
        address: "",
        department_id: null,
        city_id: null,
        state_id: null,
        country_id: null,
        zip: "",
        birthday: "",
        date_hired: "",
      },
      items: [],
      fields: [
        {
          key: "firstname",
          label: this.$t("firstname"),
        },
        {
          key: "lastname",
          label: this.$t("lastname"),
        },
        {
          key: "middlename",
          label: this.$t("middle_name"),
        },
        {
          key: "address",
          label: this.$t("address"),
        },
        {
          key: "department_id",
          label: this.$t("department"),
        },
        {
          key: "city_id",
          label: this.$t("city"),
        },
        {
          key: "state_id",
          label: this.$t("state"),
        },
        {
          key: "country_id",
          label: this.$t("country"),
        },
        {
          key: "zip",
          label: this.$t("zip"),
        },
        {
          key: "birthday",
          label: this.$t("birthday"),
        },
        {
          key: "date_hired",
          label: this.$t("date_hired"),
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
    this.GetOptionData();
  },
  methods: {
    InitailData() {
      this.filterData.firstname = "";
      this.filterData.lastname = "";
      this.filterData.department_id = null;
      this.modalTitle = "";
      this.selectedEmployeeId = 0;
      this.firstnameFlag = 0;
      this.lastnameFlag = 0;
      this.addressFlag = 0;
      this.departmentFlag = 0;
      this.cityFlag = 0;
      this.stateFlag = 0;
      this.countryFlag = 0;
      this.zipFlag = 0;
    },
    GetOptionData() {
      axios({
        url: `/api/department/getdata`,
        method: "get",
      })
        .then((response) => {
          if (response.data.length == 0) {
            this.department_options = [];
          } else {
            for (let index = 0; index < response.data.length; index++) {
              this.department_options.push({
                value: response.data[index].id,
                text: response.data[index].name,
              });
            }
          }
        })
        .catch((error) => {
          console.error(error.message);
        });

      axios({
        url: `/api/city/getdata`,
        method: "get",
      })
        .then((response) => {
          if (response.data.length == 0) {
            this.city_options = [];
          } else {
            for (let index = 0; index < response.data.length; index++) {
              this.city_options.push({
                value: response.data[index].id,
                text: response.data[index].name,
              });
            }
          }
        })
        .catch((error) => {
          console.error(error.message);
        });

      axios({
        url: `/api/state/getdata`,
        method: "get",
      })
        .then((response) => {
          if (response.data.length == 0) {
            this.state_options = [];
          } else {
            for (let index = 0; index < response.data.length; index++) {
              this.state_options.push({
                value: response.data[index].id,
                text: response.data[index].name,
              });
            }
          }
        })
        .catch((error) => {
          console.error(error.message);
        });

      axios({
        url: `/api/country/getdata`,
        method: "get",
      })
        .then((response) => {
          if (response.data.length == 0) {
            this.country_options = [];
          } else {
            for (let index = 0; index < response.data.length; index++) {
              this.country_options.push({
                value: response.data[index].id,
                text: response.data[index].name,
              });
            }
          }
        })
        .catch((error) => {
          console.error(error.message);
        });
    },
    GetData() {
      axios({
        url: `/api/employee/getdata`,
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
      if (
        this.filterData.firstname == "" &&
        this.filterData.lastname == "" &&
        this.filterData.department_id == null
      ) {
        this.GetData();
      } else {
        axios({
          url: `/api/employee/filterdata`,
          method: "post",
          data: this.filterData,
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
        this.modalData.firstname = "";
        this.modalData.lastname = "";
        this.modalData.middlename = "";
        this.modalData.address = "";
        this.modalData.department_id = null;
        this.modalData.city_id = null;
        this.modalData.state_id = null;
        this.modalData.country_id = null;
        this.modalData.zip = "";
        this.modalData.birthday = "";
        this.modalData.date_hired = "";
        this.modalTitle = this.$t("add_new");
        $("#update_button").hide(0);
        $("#add_button").show(0);
        this.selectedEmployeeId = index;
      } else {
        this.modalData.firstname = index.item.firstname;
        this.modalData.lastname = index.item.lastname;
        this.modalData.middlename = index.item.middlename;
        this.modalData.address = index.item.address;
        this.modalData.department_id = index.item.department_id;
        this.modalData.city_id = index.item.city_id;
        this.modalData.state_id = index.item.state_id;
        this.modalData.country_id = index.item.country_id;
        this.modalData.zip = index.item.zip;
        this.modalData.birthday = index.item.birthday;
        this.modalData.date_hired = index.item.date_hired;
        this.modalTitle = this.$t("update") + " " + this.$t("employee");
        $("#add_button").hide(0);
        $("#update_button").show(0);
        this.selectedEmployeeId = index.item.id;
      }
    },
    VaildateField() {
      if (this.modalData.firstname == "") {
        Vue.$toast.open({
          message: this.$t("firstname") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.firstnameFlag = 1;
      }

      if (this.modalData.lastname == "") {
        Vue.$toast.open({
          message: this.$t("lastname") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.lastnameFlag = 1;
      }

      if (this.modalData.address == "") {
        Vue.$toast.open({
          message: this.$t("address") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.addressFlag = 1;
      }

      if (this.modalData.department_id == null) {
        Vue.$toast.open({
          message: this.$t("department") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.departmentFlag = 1;
      }

      if (this.modalData.city_id == null) {
        Vue.$toast.open({
          message: this.$t("city") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.cityFlag = 1;
      }

      if (this.modalData.state_id == null) {
        Vue.$toast.open({
          message: this.$t("state") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.stateFlag = 1;
      }

      if (this.modalData.country_id == null) {
        Vue.$toast.open({
          message: this.$t("country") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.countryFlag = 1;
      }

      if (this.modalData.zip == "") {
        Vue.$toast.open({
          message: this.$t("zip") + this.$t("required_field"),
          type: "error",
        });
      } else {
        this.zipFlag = 1;
      }
    },
    AddEmployee() {
      this.VaildateField();

      if (
        this.firstnameFlag == 1 &&
        this.lastnameFlag == 1 &&
        this.addressFlag == 1 &&
        this.departmentFlag == 1 &&
        this.cityFlag == 1 &&
        this.stateFlag == 1 &&
        this.countryFlag == 1 &&
        this.zipFlag == 1
      ) {
        axios({
          url: `/api/employee/create`,
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
            $("#myModal").modal("hide");
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    UpdateEmployee() {
      this.VaildateField();

      if (
        this.firstnameFlag == 1 &&
        this.lastnameFlag == 1 &&
        this.addressFlag == 1 &&
        this.departmentFlag == 1 &&
        this.cityFlag == 1 &&
        this.stateFlag == 1 &&
        this.countryFlag == 1 &&
        this.zipFlag == 1
      ) {
        axios({
          url: `/api/employee/update/${this.selectedEmployeeId}`,
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
            $("#myModal").modal("hide");
          })
          .catch((error) => {
            console.error(error.message);
          });
      }
    },
    DeleteEmployee(index) {
      this.selectedEmployeeId = index;
    },
    ConfirmDelete() {
      axios({
        url: `/api/employee/delete/${this.selectedEmployeeId}`,
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
  margin-right: 5px;
}

.padding-top {
  padding-top: 18px;
}

.sub-font-size {
  font-size: 10px;
}

.cursor {
  cursor: pointer;
}
</style>