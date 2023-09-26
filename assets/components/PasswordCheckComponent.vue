<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <input type="password" class="form-control" v-model="password" name="passwordFieldNameFirst" placeholder="Mot de passe">
        <input type="password" class="form-control" v-model="confirmPassword" :name="passwordFieldNameSecond" placeholder="Confirmez le mot de passe">
        <span v-if="passwordCheckFailed" style="color: red;">Les mots de passe doivent correspondre.</span>
      </div>
    </div>
  </div>
</template>



<script>
export default {
    data() {
        return {
            passwordFieldNameFirst: "{{ registrationForm.plainPassword.first.vars.full_name }}",
            passwordFieldNameSecond: "{{ registrationForm.plainPassword.second.vars.full_name }}",
            password: "",
            confirmPassword: "",
        };
    },
    watch: {
        password(newVal) {
            const el = document.querySelector('[name="{{ registrationForm.plainPassword.first.vars.full_name }}"]');
            if (el) {
                el.value = newVal;
            }
        },
        confirmPassword(newVal) {
            const el = document.querySelector('[name="{{ registrationForm.plainPassword.second.vars.full_name }}"]');
            if (el) {
                el.value = newVal;
            }
        },
    },
    computed: {
        passwordCheckFailed() {
            return this.password && this.confirmPassword && this.password !== this.confirmPassword;
        }
    }
}
</script>

