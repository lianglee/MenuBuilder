.menu-builder-icons {
    text-align: center;
}
.menu-builder-icons-selected,
.menu-builder-icons li:hover {
    background: #eee;
    cursor: pointer;
}
.menu-builder-icons li {
	display: inline-block;
    padding: 10px;
    width: 50px;
    height: 50px;
    text-align: center;
    border: 1px solid #eee;
}
.menu-builder-icons li i{
    font-size: 25px;
}

.ossn-loading-menubuilder:not(:required) {
	-moz-animation: three-quarters-loader 1250ms infinite linear;
	-webkit-animation: three-quarters-loader 1250ms infinite linear;
	animation: three-quarters-loader 1250ms infinite linear;
	border: 8px solid #38e;
	border-right-color: transparent;
	border-radius: 16px;
	box-sizing: border-box;
	position: relative;
	overflow: hidden;
	text-indent: -9999px;
	width: 24px;
	height: 24px;
}
@-moz-keyframes three-quarters-loader {
	0% {
		-moz-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		-moz-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}

@-webkit-keyframes three-quarters-loader {
	0% {
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		-webkit-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}

@keyframes three-quarters-loader {
	0% {
		-moz-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		-moz-transform: rotate(360deg);
		-ms-transform: rotate(360deg);
		-webkit-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}
.menubuilder-item-admin-sidemenu i,
.menubuilder-item-topbar-admin i {
	float:none !important;
    margin-right:5px;
    margin-left:0px !important;
}