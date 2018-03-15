<?php
/**
 * Part of the Vaseman Prototype System files.
 *
 * @copyright  Copyright (C) 2013 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Vaseman\Helper;

use Windwalker\Core\View\Helper\AbstractHelper;

/**
 * Class Blog
 *
 * @package Helper
 */
class BlogHelper extends AbstractHelper
{
    /**
     * @var string
     */
    protected $data = <<<JSON
[{"id": 2,"asset_id": 0,"parent_id": 0,"lft": 0,"rgt": 0,"level": 0,"path": "","catid": 1,"title": "雲彩裡，許是懺悔，她多疼你！","alias": "cloud-xu-repentance-her-pain-you","url": "http://asikart.com/","introtext": "<p>他們的獨子，他們的獨子，卻沒有同樣的碎痕，一般青的青草同在大地上生長，就是你媽，美慧，我只是悵惘，我心裡卻並不快爽；因為不僅見著他使我想起你，還是有人成心種著的？今天頭上已見星星的白髮；光陰帶走的往跡，在這道上遭受的，在你最初開口學話的日子，你去時也還是一個光亮，可以懂得我話裡意味的深淺，你應得躲避她像你躲避青草裡一條美麗的花蛇！</p>","fulltext": "<p>可愛，說你聽著了音樂便異常的快活，竟可說是你有天賦的憑證，假如你長大的話，有時激起成章的波動，但我不僅不能盡我的責任，拘束永遠跟著我們，與我境遇相似或更不如的當不在少數，他就捲了起來，與你一撮的遺灰，梨夢湖與西子湖，體態的秀美，葛德說，你應得躲避她像你躲避青草裡一條美麗的花蛇！體態的秀美，我見著的只你的遺像，有時激起成章的波動，只要你一伸手就可以採取，想起怎不可傷？在這裡，前途是那裡，前途是那裡，怎樣你這小機靈早已看見，同時她們講你生前的故事，他拉著我的手，我們多長一歲年紀往往只是加重我們頭上的枷，我在一個地方聽音樂，與我境遇相似或更不如的當不在少數，因為在幾分鐘內我們已經是很好的朋友，但我們，你應得躲避她像你躲避青草裡一條美麗的花蛇！百靈與夜鶯，摸著了你的寶貝，也許是你自己種下的？</p>","images": "images/sampledata/parks/landscape/250px_cradle_mountain_seen_from_barn_bluff.jpg","version": 0,"created": "2012-09-08 14:04:41","created_by": 39,"modified": "2012-09-08 14:37:19","modified_by": 39,"ordering": 1,"published": 1,"publish_up": "0000-00-00 00:00:00","publish_down": "0000-00-00 00:00:00","checked_out": 0,"checked_out_time": "0000-00-00 00:00:00","access": 1,"language": "*","params": ""}, {"id": 3,"asset_id": 0,"parent_id": 0,"lft": 0,"rgt": 0,"level": 0,"path": "","catid": 1,"title": "流，同在一個神奇的宇宙裡自得。","alias": "flow-with-contented-in-a-magical-universe","url": "https://www.facebook.com","introtext": "<p>山勢與地形的起伏裡，的本領，體魄與性靈，而且往往因為他是從繁花的山林裡吹度過來他帶來一股幽遠的淡香，但她在她同樣不幸的境遇中證明她的智斷，站在漆黑的床邊，你得有力量翻起那岩石才能把它不傷損的連根起出誰知道那根長的多深！你在時我不知愛惜，他上年紀的臉上一定滿佈著笑容你的小腳踝上不曾碰著過無情的荊刺，他們承著你的體重卻不叫你記起你還有一雙腳在你的底下。</p>","fulltext": "<p>可愛的小彼得，這樣的玩頂好是不要約伴，我怕我只能看作水面上的雲影，我不能恨，你的父親，就是你媽，你媽說，是貝德花芬是槐格納你就愛，尤在你永不須躊躇你的服色與體態；你不妨搖曳著一頭的蓬草，眼不盲，說你在坐車裡常常伸出你的小手在車欄上跟著音樂按拍；你稍大些會得淘氣的時候，她多疼你！今天已是壯年；昨天腮邊還帶著圓潤的笑渦，你盡可以不用領結，你在時我不知愛惜，我們唯一的權利，山勢與地形的起伏裡，一個不相識的小孩，知道你，山勢與地形的起伏裡，遠山上不起靄，親口嘗味，與你自己隨口的小曲，但你要它們的時候，一同聽台上的音樂。那才是你實際領受，你便蓋沒了你的小耳，這慈愛的甘液不能救活已經萎折了的鮮花，直到你的影像活現在我的眼前，我見著的只你的遺像，連著一息滋潤的水氣，覺著心裡有一個尖銳的刺痛，但這幾件故事已夠見證你小小的靈性裡早長著音樂的慧根。我心頭便湧起了不少的感想；我的話你是永遠聽不著了，是懺悔，那太可愛，但我想借這悼念你的機會，挫折時有鼓勵，與他同年齡的影子。</p>","images": "images/sampledata/fruitshop/bananas_2.jpg","version": 0,"created": "2012-09-08 14:12:04","created_by": 39,"modified": "2012-09-08 14:41:06","modified_by": 39,"ordering": 2,"published": 0,"publish_up": "0000-00-00 00:00:00","publish_down": "0000-00-00 00:00:00","checked_out": 0,"checked_out_time": "0000-00-00 00:00:00","access": 1,"language": "*","params": ""}, {"id": 4,"asset_id": 0,"parent_id": 0,"lft": 0,"rgt": 0,"level": 0,"path": "","catid": 1,"title": "有時一澄到底的清澈，我只能問！","alias": "sometimes-a-cheng-clear-in-the-end-i-can-only-ask","url": "http://www.joomla123.com.tw/","introtext": "<p>比如去一果子園，多謝你媽與你大大的慈愛與真摯，我心頭便湧起了不少的感想；我的話你是永遠聽不著了，卻不是來作客；我們是遭放逐，說你聽著了音樂便異常的快活，與我境遇相似或更不如的當不在少數，活潑的靈魂；你來人間真像是短期的作客，想起怎不可傷？我們唯一的權利，他說的話我不懂，你得有力量翻起那岩石才能把它不傷損的連根起出誰知道那根長的多深！</p>","fulltext": "<p>流，比方說，把一個小花圈掛上你的門前那時間我，昨天我是個孩子，明知是自苦的揶揄，百靈與夜鶯，說你在坐車裡常常伸出你的小手在車欄上跟著音樂按拍；你稍大些會得淘氣的時候，那是最危險最專制不過的旅伴，你知道的是慈母的愛，像一個裸體的小孩撲入他母親的懷抱時，裝一個農夫，解嘲已往的一切。講，自由與自在的時候，我們見小孩子在草裡在沙堆裡在淺水裡打滾作樂，假如你單是站著看還不滿意時，但我不僅不能盡我的責任，可以恣嘗鮮味，更不提一般黃的黃麥，流入嫵媚的阿諾河去……並且你不但不須應伴，這不取費的最珍貴的補劑便永遠供你的受用；只要你認識了這一部書，反是這般不近情的冷漠？與他一樣，今天頭上已見星星的白髮；光陰帶走的往跡，它們又不在口邊；像是長在大塊岩石底下的嫩草，我猜想，你生前日常把弄的玩具小車，摩挲著你的顏面，光亮的天真，也不免加添他們的煩愁，你生前日常把弄的玩具小車，誰沒有恨，他那資質的敏慧，因為在幾分鐘內我們已經是很好的朋友，她多疼你！她們又講你怎樣喜歡拿著一根短棍站在桌上摹仿音樂會的導師，那才是你實際領受，是貝德花芬是槐格納你就愛，那無非是在同一個大牢裡從一間獄室移到另一間獄室去，美慧，我們真的羨慕，覺著心裡有一個尖銳的刺痛，還是有人成心種著的？</p>","images": "images/sampledata/parks/animals/220px_spottedquoll_2005_seanmcclean.jpg","version": 0,"created": "2012-09-08 14:15:15","created_by": 39,"modified": "2012-09-08 14:41:15","modified_by": 39,"ordering": 3,"published": 1,"publish_up": "2017-09-08 00:00:00","publish_down": "0000-00-00 00:00:00","checked_out": 0,"checked_out_time": "0000-00-00 00:00:00","access": 2,"language": "*","params": ""}, {"id": 5,"asset_id": 0,"parent_id": 0,"lft": 0,"rgt": 0,"level": 0,"path": "","catid": 1,"title": "活潑，花草的顏色與香息裡尋得？","alias": "and-lively-the-color-of-flowers-and-incense-bearing-years-have-found","url": "http://ilovejoomla.tw/","introtext": "<p>這才初次明白曾經有一點血肉從我自己的生命裡分出，此外還有不少趣話，和風中，正像是去赴一個美的宴會，體態的秀美，她們又講你怎樣喜歡拿著一根短棍站在桌上摹仿音樂會的導師，在你最初開口學話的日子，他那資質的敏慧，平常我們從自己家裡走到朋友的家裡，反是這般不近情的冷漠？</p>","fulltext": "<p>自然是最偉大的一部書，即使有，我在一個地方聽音樂，雲彩裡，就這單純的呼吸已是無窮的愉快；空氣總是明淨的，至少你不能完全抱怨荊棘，因此我有時想，她的忍耐，想中止也不可能，你媽已經寫信給我，平常我們從自己家裡走到朋友的家裡，但你應得帶書，同時她們講你生前的故事，還是有人成心種著的？同在和風中波動他們應用的符號是永遠一致的，還不止是難，想起怎不可傷？因為在幾分鐘內我們已經是很好的朋友，或是看見小貓追他自己的尾巴，極端的自私，流入嫵媚的阿諾河去……並且你不但不須應伴，比你住久的，你在時，給你應得的慈愛，也許是你自己種下的？我心頭便湧起了不少的感想；我的話你是永遠聽不著了，但你要它們的時候，你盡可以不用領結，上山或是下山，我只能問！體態的秀美，我們的鏈永遠是制定我們行動的上司！</p>","images": "images/sampledata/parks/animals/200px_phyllopteryx_taeniolatus1.jpg","version": 0,"created": "2012-09-08 14:16:31","created_by": 39,"modified": "2012-09-08 14:41:18","modified_by": 39,"ordering": 4,"published": 1,"publish_up": "0000-00-00 00:00:00","publish_down": "2010-09-08 00:00:00","checked_out": 0,"checked_out_time": "0000-00-00 00:00:00","access": 3,"language": "*","params": ""}, {"id": 6,"asset_id": 0,"parent_id": 0,"lft": 0,"rgt": 0,"level": 0,"path": "","catid": 1,"title": "可愛，不是在你獨身漫步的時候。","alias": "cute-is-not-in-when-you-stroll-celibacy","url": "http://funni.cc/","introtext": "<p>你才知道靈魂的愉快是怎樣的，愛你，雪西里與普陀山，像一個裸體的小孩撲入他母親的懷抱時，他的肖像也常受你小口的親吻，這時候想回頭已經太遲，學一個太平軍的頭目，所以只有你單身奔赴大自然的懷抱時，別管他模樣不佳，小鵝，誰沒有恨，你回到了天父的懷抱，近谷內不生煙，反是這般不近情的冷漠？</p>","fulltext": "<p>你離開了媽的懷抱，在她有機會時，尤其是年輕的女伴，他年紀雖則小，也只有她，你就會在青草裡坐地仰臥，在這裡出門散步去，甚至有時打滾，也不免加添他們的煩愁，約莫八九歲光景，像一個裸體的小孩撲入他母親的懷抱時，有時激起成章的波動，竟許有人同情。山罅裡的泉響，你應得躲避她像你躲避青草裡一條美麗的花蛇！一般青的青草同在大地上生長，我手捧著那收存你遺灰的錫瓶，卻偏不作聲，再也不容追贖，你應得躲避她像你躲避青草裡一條美麗的花蛇！流，流，不如意的人生，今天已是壯年；昨天腮邊還帶著圓潤的笑渦，何嘗沒有羨慕的時候，是它們自己長著，給你應得的慈愛，我問為什麼，你的思想和著山壑間的水聲，是它們自己長著，陽光正好暖和，輕繞著你的肩腰，作客山中的妙處，誰沒有恨，與你自己隨口的小曲，要是中國的戲片，與他同年齡的影子。比你住久的，但我們的枷，她的忍耐，你媽說，可以懂得我話裡意味的深淺，加緊我們腳脛上的鏈，但我想借這悼念你的機會，你便蓋沒了你的小耳，光亮的天真，一經同伴的牴觸，你便乖乖的把琴抱進你的床去，他就捲了起來，葛德說，而且往往因為他是從繁花的山林裡吹度過來他帶來一股幽遠的淡香，是悵惘？</p>","images": "images/sampledata/parks/landscape/180px_ormiston_pound.jpg","version": 0,"created": "2012-09-08 14:26:08","created_by": 39,"modified": "2012-09-08 14:41:22","modified_by": 39,"ordering": 5,"published": 1,"publish_up": "0000-00-00 00:00:00","publish_down": "0000-00-00 00:00:00","checked_out": 0,"checked_out_time": "0000-00-00 00:00:00","access": 1,"language": "en-GB","params": ""}]
JSON;

    /**
     * getArticles
     *
     * @return mixed
     */
    public function getArticles()
    {
        return json_decode($this->data, true);
    }

    /**
     * getCategories
     *
     * @return array
     */
    public function getCategories()
    {
        return [
            [
                'id' => 1,
                'title' => 'Sample Data-Articles',
                'alias' => 'sample-data-articles',
                'access' => 'Public',
                'language' => 'All',
                'published' => 1,
                'level' => 1
            ],

            [
                'id' => 1,
                'title' => 'Joomla!',
                'alias' => 'joomla',
                'access' => 'Public',
                'language' => 'All',
                'published' => 1,
                'level' => 1
            ],

            [
                'id' => 1,
                'title' => 'Extensions',
                'alias' => 'extensions',
                'access' => 'Public',
                'language' => 'All',
                'published' => 1,
                'level' => 2
            ],

            [
                'id' => 1,
                'title' => 'Modules',
                'alias' => 'modules',
                'access' => 'Public',
                'language' => 'All',
                'published' => 1,
                'level' => 3
            ],

            [
                'id' => 1,
                'title' => 'YOOTheme',
                'alias' => 'yootheme',
                'access' => 'Public',
                'language' => 'All',
                'published' => 1,
                'level' => 1
            ],
        ];
    }

    /**
     * repeat
     *
     * @param $str
     * @param $num
     *
     * @return string
     */
    public function repeat($str, $num)
    {
        return str_repeat($str, $num);
    }
}
