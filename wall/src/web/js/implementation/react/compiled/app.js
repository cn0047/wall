"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Message = function (_React$Component) {
    _inherits(Message, _React$Component);

    function Message() {
        _classCallCheck(this, Message);

        return _possibleConstructorReturn(this, (Message.__proto__ || Object.getPrototypeOf(Message)).apply(this, arguments));
    }

    _createClass(Message, [{
        key: "render",
        value: function render() {
            return React.createElement(
                "div",
                { className: "message" },
                React.createElement(
                    "div",
                    { className: "body" },
                    this.props.data.message
                ),
                React.createElement(
                    "div",
                    { className: "foot" },
                    React.createElement(
                        "i",
                        null,
                        React.createElement(
                            "span",
                            { className: "date text-muted pull-right" },
                            this.props.data.createdAt
                        )
                    )
                )
            );
        }
    }]);

    return Message;
}(React.Component);

var Header = function (_React$Component2) {
    _inherits(Header, _React$Component2);

    function Header(props) {
        _classCallCheck(this, Header);

        var _this2 = _possibleConstructorReturn(this, (Header.__proto__ || Object.getPrototypeOf(Header)).call(this, props));

        _this2.state = { message: '' };
        _this2.handleChange = _this2.handleChange.bind(_this2);
        _this2.handleSubmit = _this2.handleSubmit.bind(_this2);
        return _this2;
    }

    _createClass(Header, [{
        key: "handleChange",
        value: function handleChange(e) {
            this.setState({ message: e.target.value });
        }
    }, {
        key: "handleSubmit",
        value: function handleSubmit(e) {
            var data = new FormData();
            data.append('userId', 0);
            data.append('message', this.state.message);
            fetch('messages/create/', { method: 'post', body: data }).then(function (res) {
                if (res.status === 400) {
                    return res.json().then(function (errors) {
                        for (var i in errors) {
                            $.growl(i + ' - ' + errors[i], { type: 'danger', position: { from: "top", align: "center" }, z_index: 9999 });
                        }
                    });
                }
                return res.json().then(function (data) {
                    $('#newDlg').modal('toggle');
                    $('#newDlg textarea').val('');
                    var messagesContainer = document.getElementById('wall');
                    var newMessage = document.createElement('div');
                    ReactDOM.render(React.createElement(Message, { data: data, key: data.id }), newMessage);
                    messagesContainer.insertBefore(newMessage, messagesContainer.firstChild);
                });
            });
        }
    }, {
        key: "render",
        value: function render() {
            return React.createElement(
                "header",
                null,
                React.createElement(
                    "button",
                    { type: "button", className: "btn success btnNewDlg", "data-toggle": "modal", "data-target": "#newDlg" },
                    React.createElement("span", { className: "glyphicon glyphicon-plus", "aria-hidden": "true" })
                ),
                React.createElement(
                    "div",
                    { className: "modal fade", id: "newDlg", tabIndex: "-1", role: "dialog", "aria-labelledby": "" },
                    React.createElement(
                        "div",
                        { className: "modal-dialog", role: "document" },
                        React.createElement(
                            "div",
                            { className: "modal-content" },
                            React.createElement(
                                "div",
                                { className: "modal-body" },
                                React.createElement("textarea", { className: "form-control", rows: "3",
                                    value: this.state.message, onChange: this.handleChange })
                            ),
                            React.createElement(
                                "div",
                                { className: "modal-body pull-right" },
                                React.createElement(
                                    "button",
                                    { type: "button", className: "btn btn-default", "data-dismiss": "modal" },
                                    "discard"
                                ),
                                React.createElement(
                                    "button",
                                    { type: "button", className: "btn btn-primary", onClick: this.handleSubmit },
                                    "save"
                                )
                            )
                        )
                    )
                )
            );
        }
    }]);

    return Header;
}(React.Component);

var Wall = function (_React$Component3) {
    _inherits(Wall, _React$Component3);

    function Wall() {
        _classCallCheck(this, Wall);

        return _possibleConstructorReturn(this, (Wall.__proto__ || Object.getPrototypeOf(Wall)).apply(this, arguments));
    }

    _createClass(Wall, [{
        key: "render",
        value: function render() {
            var messages = [];
            this.props.messages.forEach(function (msg) {
                messages.push(React.createElement(Message, { data: msg, key: msg.id }));
            });
            return React.createElement(
                "div",
                { id: "wall" },
                messages
            );
        }
    }]);

    return Wall;
}(React.Component);

var App = function (_React$Component4) {
    _inherits(App, _React$Component4);

    function App() {
        _classCallCheck(this, App);

        return _possibleConstructorReturn(this, (App.__proto__ || Object.getPrototypeOf(App)).apply(this, arguments));
    }

    _createClass(App, [{
        key: "render",
        value: function render() {
            return React.createElement(
                "div",
                null,
                React.createElement(Header, null),
                React.createElement(Wall, { messages: this.props.messages })
            );
        }
    }]);

    return App;
}(React.Component);

fetch('messages/get/?limit=20&offset=0').then(function (result) {
    return result.json();
}).then(function (messages) {
    ReactDOM.render(React.createElement(App, { messages: messages }), document.getElementById('root'));
});
