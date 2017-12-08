require('./bootstrap');

import ModalEvent from './components/module_modal/ModalEvent.vue'

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
        'modal-event': ModalEvent,
    },
    methods: {
        popModal: function (email) {
            var that = this;
            that.email = email
        },
    }
});
