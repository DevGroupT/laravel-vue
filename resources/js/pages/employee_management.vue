<template>
  <div>
    <div class="row">
      <div class="col-2">
        <input
          type="text"
          class="form-control"
          id="in_firstname"
          :placeholder="$t('firstname')"
        />
      </div>
      <div class="col-2">
        <input
          type="text"
          class="form-control"
          id="in_lastname"
          :placeholder="$t('lastname')"
        />
      </div>
      <div class="col-2">
        <input
          type="text"
          class="form-control"
          id="in_department"
          :placeholder="$t('department')"
        />
      </div>
      <div class="col-3">
        <button type="button" class="btn btn-primary" @click="Filter">
          {{ $t("filter") }}
        </button>
      </div>
      <div class="col-3 right-side">
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#addModal"
        >
          {{ $t("add_new") }}
        </button>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">
              {{ $t("add_new") }}
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
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="AddEmployee">
              {{ $t("add_new") }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-12">Table</div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
Vue.use(VueToast);

export default {
  middleware: "auth",
  metaInfo() {
    return { title: this.$t("employee_management") };
  },
  methods: {
    Filter() {},
    AddEmployee() {},
  },
};
</script>

<style lang="scss" scoped>
.right-side {
  text-align: right;
}
</style>