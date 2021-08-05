<template>
  <div class="main-layout">
    <div>
      <sidebar-menu
        :menu="menu"
        id="sidebar"
        @toggle-collapse="ChangeSidebar"
        v-if="authenticated"
      />
    </div>
    <div id="main">
      <navbar />
      <div class="container mt-4">
        <child />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Navbar from "~/components/Navbar";
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";
import { SidebarMenu } from "vue-sidebar-menu";
import "vue-sidebar-menu/dist/vue-sidebar-menu.css";

export default {
  name: "MainLayout",

  components: {
    Navbar,
    SidebarMenu,
  },
  computed: mapGetters({
    authenticated: "auth/check",
  }),
  watch: {
    authenticated(authenticated) {
      if (authenticated) {
        document.getElementById("main").style.marginLeft = "350px";
      } else {
        document.getElementById("sidebar").style.width = "0px";
        document.getElementById("main").style.marginLeft = "0px";
      }
    },
  },
  data() {
    return {
      menu: [
        {
          header: true,
          title: "Main Navigation",
          hiddenOnCollapse: true,
        },
        {
          href: "/home",
          title: this.$t("dashboard"),
          icon: "fa fa-home",
        },
        {
          href: "/employee_management",
          title: this.$t("employee_management"),
          icon: "fa fa-home",
        },
        {
          title: this.$t("system_management"),
          icon: "fa fa-home",
          child: [
            {
              href: "/system_management/country",
              title: this.$t("country"),
            },
            {
              href: "/system_management/state",
              title: this.$t("state"),
            },
            {
              href: "/system_management/city",
              title: this.$t("city"),
            },
            {
              href: "/system_management/department",
              title: this.$t("department"),
            },
          ],
        },
        {
          href: "/user_management",
          title: this.$t("user_management"),
          icon: "fa fa-user",
        },
      ],
    };
  },
  mounted() {
    document.getElementById("sidebar").style.width = "350px";
    document.getElementById("main").style.marginLeft = "350px";
  },
  methods: {
    ChangeSidebar() {
      if (document.getElementById("sidebar").offsetWidth == 350) {
        document.getElementById("main").style.marginLeft = "50px";
      } else {
        document.getElementById("main").style.marginLeft = "350px";
      }
    },
  },
};
</script>

<style lang="scss" scoped>
#main {
  transition: margin-left 0.5s;
}
</style>