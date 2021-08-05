<template>
  <card :title="$t('user_management')">
    {{ $t("you_are_logged_in") }}
  </card>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("user_management") };
  },
};
</script>
