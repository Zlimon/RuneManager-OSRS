<template>
    <div>
        <div class="float-left ml-3">
            <h1 class="text-left">{{ data.username }}</h1>

            <span>Rank: <strong>{{ data.rank }}</strong></span>
            <br>
            <span>Total XP: <strong>{{ data.xp }}</strong></span>
            <br>
            <span>Total Level: <strong>{{ data.level }}</strong></span>
            <br>
            <span>Joined: <strong>{{ data.joined }}</strong></span>
        </div>

        <table>
            <tr>
                <th></th>
                <th>Kill Count</th>
                <th>Hiscore Rank</th>
                <th>Collection Log</th>
                <th>Obtained</th>
            </tr>
            <tr v-for="(hiscore, name) in meta.bossHiscores">
                <td>
                    <a :href="'/hiscore/boss/' + name">
                        <img :alt="hiscore.alias + ' boss icon'"
                             :src="'/images/boss/' + name + '.png'"
                             :title="'Click here to visit ' + hiscore.alias + ' hiscores'"
                             class="pixel hiscore-icon">
                        <span>{{ hiscore.alias }}</span>
                    </a>
                </td>
                <td>{{ hiscore.kill_count }}</td>
                <td>{{ hiscore.rank }}</td>
                <td>
                    <a :data-target="$idRef(name.replace(/ /g, '_'))" class="btn background-world-map"
                       data-toggle="modal">
                        <img :title="'Click here to see collection log for ' + hiscore.alias"
                             alt="Collection log item icon"
                             src="https://www.osrsbox.com/osrsbox-db/items-icons/22711.png">
                    </a>
                </td>
                <td>
                    <div v-if="(hiscore.obtained !== null ? hiscore.obtained : 0) === hiscore.total">
                        <span class="runescape-success">
                            {{ (hiscore.obtained !== null ? hiscore.obtained : 0) }} / {{ hiscore.total }}
                        </span>
                    </div>
                    <div v-else-if="hiscore.obtained > 0">
                        <span class="runescape-progress">{{ hiscore.obtained }} / {{ hiscore.total }}</span>
                    </div>
                    <div v-else>
                        <span class="runescape-danger">
                            {{ (hiscore.obtained !== null ? hiscore.obtained : 0) }} / {{ hiscore.total }}
                        </span>
                    </div>
                </td>
                <div :id="$id(name.replace(/ /g, '_'))" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-body background-dialog-iron-rivets text-light">
                                <button class="btn btn-lg button-window-close float-right"
                                        data-dismiss="modal"></button>
                                <h1>{{ data.username }}</h1>
                                <div class="d-flex flex-row flex-wrap justify-content-center">
                                    <div v-for="(count, item) in hiscore.log"
                                         class="collection-log-item background-world-map bg-dark p-4">
                                        <div v-if="count === 1">
                                            <img :alt="item + ' item icon'"
                                                 :src="'/images/boss/' + name.replace(/ /g, '_') + '/' + item + '.png'"
                                                 :title="item.replaceAll('_', ' ') | capitalize"
                                                 class="pixel hiscore-icon">
                                        </div>
                                        <div v-else-if="count > 0">
                                            <img :alt="item + ' item icon'"
                                                 :src="'/images/boss/' + name.replace(/ /g, '_') + '/' + item + '.png'"
                                                 :title="item.replaceAll('_', ' ') | capitalize"
                                                 class="pixel hiscore-icon">
                                            <span class="collection-log-item-counter runescape-progress">
                                                {{ count }}
                                            </span>
                                        </div>
                                        <div v-else>
                                            <img :alt="item + ' item icon'"
                                                 :src="'/images/boss/' + name.replace(/ /g, '_') + '/' + item + '.png'"
                                                 :title="item.replaceAll('_', ' ') | capitalize"
                                                 class="pixel hiscore-icon faded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        account: {type: String, required: true},
    },

    data() {
        return {
            data: {},
            meta: {}
        }
    },

    mounted() {
        axios
            .get('/api/account/' + this.account + '/boss')
            .then((response) => {
                this.data = response.data.data;
                this.meta = response.data.meta;
            })
            .catch(error => (console.log(error)))
    },

    filters: {
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        },
    }
}
</script>
