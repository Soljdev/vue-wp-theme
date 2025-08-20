export default {
  ADD_ITEM(state, { type, item }) {
    if (item && type && ! state[type].hasOwnProperty(item.id)) {
      state[type][item.id] = item
    }
  },
  ADD_REQUEST(state, { type, request }) {
    state[type].requests.push(request)
  },
  SET_LOADING(state, loading) {
    state.site.loading = loading
  },
  SET_DOC_TITLE(state, title) {
    state.site.docTitle = title
  },
  UPDATE_PHONE(state, phone) {
    state.site.company.contacts.phone = phone || false;
  },
  SET_CHANGE_PHONE(state, value) {
    state.site.changePhone = value;
  }
}
