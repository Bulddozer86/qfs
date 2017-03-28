import React, { Component } from 'react';
import { connect } from  'react-redux';

// import List from './components/searchList';
// import Form from './components/searchForm';

class App extends Component {
    render() {
        return (
            <div className="col-lg-12">
                <div className="well">
                    <h1>Hello world</h1>
                </div>
            </div>

        );
    }
}

function mapStateToProps (state) {
    return state
}

export default connect(mapStateToProps)(App)
