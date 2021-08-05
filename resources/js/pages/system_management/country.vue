<template>
  <card :title="$t('country')">
    {{ $t("you_are_logged_in") }}
  </card>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("country") };
  },
};
</script>
