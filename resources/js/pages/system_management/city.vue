<template>
  <card :title="$t('city')">
    {{ $t("you_are_logged_in") }}
  </card>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("city") };
  },
};
</script>
