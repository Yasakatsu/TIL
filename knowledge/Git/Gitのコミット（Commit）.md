変更が終わったら
git status 
コマンドで現在の状態を確認してみましょう。
git add -Aと実行することもできますが、
git commitには
すべての変更ファイル（git mvで作成したファイルも含む）を
まとめてコミットする-aオプションもあります。
このオプションを使うと、以下のようにコミットすることもできます。

$ git commit -a -m "Improve the README file"
[modify-README 34bb6a5] Improve the README file
 1 file changed, 5 insertions(+), 22 deletions(-)

ただしgit commit -aやgit add -Aでは、
意図していないファイルを誤ってコミットしてしまう可能性もあるため注意が必要です。
不安な場合は、
git add README
や
git add .
のように
追加するファイル名またはディレクトリ名を指定し、
git statusで対象ファイルを確認後、git commitでコミットしましょう。

git commitのコミットメッセージを英語で書く場合は現在形かつ命令形で書くようにしましょう44 。
というのも、コミットメッセージではそのコミットが「何をした」のかを書くよりも、
「何をする」ためのものなのかを書く方が後から見返したときに分かりやすくなるからです。
さらに、現在形かつ命令形で書いておけば、
Git自身が自動的に生成するコミットメッセージ（例えば Merge pull request #123 ... など）とも時制が一致します。














































 







































