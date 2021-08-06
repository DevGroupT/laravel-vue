<template>
<div>
    <div class="row">
      <div class="col-6 col-sm-4 col-md-2">
        <input
          type="text"
          class="form-control"
          :placeholder="$t('email')"
        /> 
      </div>
      <div class="col-6 col-sm-4 col-md-2">
        <input
          type="text"
          class="form-control"
          :placeholder="$t('username')"
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
    <card :title="$t('users')">
      <div class="row">
        <div class="col-12">Table</div>
      </div>
      
      
    </card>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("user_management") };
  },
};
</script>
