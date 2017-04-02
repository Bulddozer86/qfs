import React, {Component} from 'react'
import {bindActionCreators} from 'redux'
import {connect} from 'react-redux'
import { createStore } from 'redux';
import { Provider } from 'react-redux';
import Page from '../components/Page'
import * as pageActions from '../actions/PageActions'

import {combineForms} from 'react-redux-form';

import SearchForm from '../components/searchForm'

const initialUser = {name: ''};

const formStore = createStore(combineForms({
  user: initialUser,
}));

class App extends Component {
  render() {
    const {page} = this.props;
    const {setSearchValue} = this.props.pageActions;

    return <Provider store={ formStore }>
      <SearchForm />
    </Provider>
  }
}

function mapStateToProps(state) {
  return {
    page: state.page
  }
}

function mapDispatchToProps(dispatch) {
  return {
    pageActions: bindActionCreators(pageActions, dispatch)
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(App)
