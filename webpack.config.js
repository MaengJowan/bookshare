const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const jsentryPath = "./application/js/comp";
module.exports = {
	//entry:최상위 자바스크립트 파일
	//name : "url"
	entry: {
		joinAction: `${jsentryPath}/joinActionComp.js`,
		index: `${jsentryPath}/indexComp.js`,
		notice: `${jsentryPath}/noticeComp.js`,
		bestSeller: `${jsentryPath}/bestSellerComp.js`,
		recommend: `${jsentryPath}/recommendComp.js`,
		recommendWrite: `${jsentryPath}/recommendWriteComp.js`,
		recommend_post: `${jsentryPath}/recommend_postComp.js`,
		mypage: `${jsentryPath}/mypageComp.js`,
		search: `${jsentryPath}/searchComp.js`,
	},
	output: {
		//path:번들링 결과값. 절대경로이어야함.
		path: "/Apache24/htdocs/bookshare2/application/dist/",
		//publicPath:서버에서 읽히는 곳 결과값이 나오는곳에다가 해야 이미지 출력됨.
		publicPath: "application/dist/",
		filename: "[name]_bundle.js",
	},
	mode: "none",
	module: {
		rules: [
			{
				test: /\.css$/,
				use: ["style-loader", "css-loader"],
			},
			{
				test: /\.(png|jpg)$/,
				use: [
					{
						loader: "file-loader",
					},
				],
			},
		],
	},
	plugins: [new CleanWebpackPlugin({ cleanAfterEveryBuildPatterns: ["dist"] })],
};
