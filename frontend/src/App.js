import React, {Component} from 'react';
import List from './components/searchList';
import Form from './components/searchForm';

export default class App extends Component {
    render() {
        return (
            <div className="col-lg-12">
                <div className="well">
                    <Form/>
                    <List/>
                </div>
            </div>

        );
    }
}
