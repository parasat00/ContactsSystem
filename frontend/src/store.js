import { createStore } from 'vuex';
import axios from 'axios';

export default new createStore({

    state: {
        user: null
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        LOGOUT(state) {
            state.user = null;
        }
    },
    actions: {
        async login({ commit }, credentials) {
            try {
                const response = await axios.post('http://backend/api/login', credentials);

                if (response.data && response.data.success) {
                    commit('SET_USER', response.data.user);
                    localStorage.setItem('token', response.data.token);
                    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                } else {
                    console.error('Invalid response: ' + response);
                }
            } catch (error) {
                console.error('Login failed:', error);
            }
        },
        async register({ commit }, userData) {
            console.log("userData: " + userData);
            try {
                console.log("userData: " + userData);
                const response = await axios.post('http://localhost/api/register', userData);
                console.log("Response: " + response);

                if (response.data && response.data.success) {
                    commit('SET_USER', response.data.user);
                    localStorage.setItem('token', response.data.token);
                    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                } else {
                    console.error('Invalid response: ' + response);
                }
            } catch (error) {
                console.error('Registration failed:', error);
            }
        },
        async logout({ commit }) {
            try {
                await axios.post('http://app/api/logout');
                commit('LOGOUT');
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization'];
            } catch(e) {
                console.log('Logout failed: ', e);
            }

        }
    },
    getters: {
        isAuthenticated: state => !!state.user
    }
});
