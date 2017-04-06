import React, {Component} from 'react'
import {bindActionCreators} from 'redux'
import {connect} from 'react-redux'
import {Provider} from 'react-redux';
import * as formActions from '../actions/formAction'

import SearchForm from '../components/searchForm'
import SearchList from '../components/searchList'

class App extends Component {
  render() {
    const formStore = this.props.form;
    const {setList} = this.props.formActions;

    return (
      <div>
        <SearchForm value={formStore.value} list={formStore.list} setList={setList}/>
        <SearchList search={formStore.list} />
      </div>
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
