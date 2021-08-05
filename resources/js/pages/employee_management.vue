<template>
  <card :title="$t('employee_management')">
    {{ $t("you_are_logged_in") }}
  </card>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("employee_management") };
  },
};
</script>
