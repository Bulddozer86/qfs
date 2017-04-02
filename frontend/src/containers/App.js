import React, {Component} from 'react'
import {bindActionCreators} from 'redux'
import {connect} from 'react-redux'
import {Provider} from 'react-redux';
import * as formActions from '../actions/formAction'

import SearchForm from '../components/searchForm'

class App extends Component {
  render() {
    const formStore = this.props.form;
    //const {setList} = this.props.formActions;

    return (
      <Provider store={ formStore }  >
        <SearchForm />
      </Provider>
    )
  }
}

function mapStateToProps(state) {
  return {
    form: state.searchForm
  }
}

function mapDispatchToProps(dispatch) {
  return {
    formActions: bindActionCreators(formActions, dispatch)
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(App)
