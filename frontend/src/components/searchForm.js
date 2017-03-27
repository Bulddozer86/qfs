import React from 'react';

const Form = new React.createClass({
    handleSubmit(e) {
        e.preventDefault();
        this.props.onSubmit(this.state);
    },

    render() {
        return (
            <form className="form" name="searchForm" onSubmit={this.handleSubmit}>
                <h4>className</h4>
                <div className="input-group text-center">
                    <input type="text" className="form-control input-lg"
                           placeholder="Enter your email address"/>
                    <span className="input-group-btn">
                        <button className="btn btn-lg btn-primary" type="button">OK</button>
                    </span>
                </div>
            </form>
        )
    }
});

export default Form;
