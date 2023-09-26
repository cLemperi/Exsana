<template>
    <button @click="deleteMessage">Supprimer</button>
</template>

<script>
import axios from 'axios';

export default {
    props: ['messageId','messageType'],
    methods: {
        async deleteMessage() {
            try {
                const response = await axios.delete(`/admin/message${this.messageType}/${this.messageId}`);
         if (response.status === 200) {
                    this.$emit('messageDeleted', this.messageId);
                }
            } catch (error) {
                console.error("Erreur lors de la suppression du message:", error);
            }
        }
    }
}
</script>
