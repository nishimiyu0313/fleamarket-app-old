// ファイル選択時に画像プレビューを表示する関数
function previewImage(input) {
    // プレビュー対象のimgタグを取得 (IDは"preview"とします)
    var imgElement = document.getElementById("preview");
    var fileReader = new FileReader();

    // ファイルの読み込みが完了したら実行
    fileReader.onload = function () {
        // imgタグのsrc属性にデータURLを設定し、プレビューとして表示
        imgElement.src = fileReader.result;
        imgElement.style.display = "block";
    };

    // 選択されたファイルをデータURLとして読み込み開始
    fileReader.readAsDataURL(input.files[0]);
}

// input要素の change イベントが発生したら previewImage 関数を実行
document.getElementById("image").addEventListener("change", function () {
    previewImage(this);
});
