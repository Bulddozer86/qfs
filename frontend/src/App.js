import React, { Component } from 'react';
import { connect } from  'react-redux';

import List from './components/searchList';
import Form from './components/searchForm';

import {bigActionCreator} from 'redux'
import * as fetchSearchData from '../actions/search';

class App extends Component {
    render() {
        const { search } = this.props;
        return (
            <div className="col-lg-12">
                <div className="well">
                    <Form/>
                    <List search={ search } />
                </div>
            </div>

        );
    }
}

function mapStateToProps (state) {
    return {
        search: state.searchData
    }
}

export default connect(mapStateToProps)(App)
