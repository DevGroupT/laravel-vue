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
        <button type="button" class="btn btn-primary">
          {{ $t("filter") }}
        </button>
      </div>
      <div class="col-3 right-side">
        <button type="button" class="btn btn-primary">
          {{ $t("add_new") }}
        </button>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-12">Table</div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  metaInfo() {
    return { title: this.$t("employee_management") };
  },
};
</script>

<style lang="scss" scoped>
.right-side {
  text-align: right;
}
</style>