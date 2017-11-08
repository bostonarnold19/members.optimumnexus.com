require('./bootstrap');

import ClientModal from './components/module_modal/ClientModal.vue'

import Vue from 'vue'
import axios from 'axios';
import _ from 'lodash';

new Vue({
    el: '#modal',
    data: {
        email: '',
    },
    mounted: function() {
        var that = this;
        $('#client-modal').on('hidden.bs.modal', function (e) {
            that.email = '';
        })
    },
    components: {
        'client-modal': ClientModal,
    },
    methods: {
        popModal: function (email) {
            var that = this;
            that.email = email
        },
    }
});
