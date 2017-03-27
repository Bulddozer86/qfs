import React, {Component} from 'react'
import {fetchSearchData} from '../actions/search';

export default class SearchList extends Component {
    constructor(props) {
        super(props);

        this.state = {
            searchData: []
        }
    };

    componentDidMount() {
        fetchSearchData()
            .then((data) => {
                this.setState(state => {
                    state.searchData = data;
                    return state;
                })
            })
            .catch((err) => {
                console.error('err', err);
            });
    };


    render() {
        return (

            <table>
                <tbody>
                    {this.state.searchData && this.state.searchData.map(s => {
                        return (
                            <tr key={s.id}>
                                <td>{s.price}</td>
                                <td>{s.headline}</td>
                            </tr>
                        )
                    })}
                </tbody>
            </table>


        );
    }
}
