<template>
    <div @click="select_answer" class="__answer">
        <div class="__answer_variant">{{ answer.variant }}</div>
        <div class="__answer_text">{{ answer.text }}</div>
    </div>
</template>
<script>
    export default {
        name: 'Answer',

        props: ['answer', 'index', 'is_work_on_error', 'is_check'],

        data () {
            return {
                label: `answer-${this.index}`
            };
        },

        methods: {

            select_answer (e) {

                e.preventDefault();
                e.stopPropagation();

                const el = e.target;
                const answer_block = el.closest('.__answer');

                if (answer_block.matches('.__answer_selected')) {

                    answer_block.classList.remove('__answer_selected');
                    answer_block.children[0].classList.remove('__answer_variant_selected');
                    answer_block.children[1].classList.remove('__answer_text_selected');
                    this.$emit('check_answer', this.answer);

                } else {

                    if (!this.is_check) {
                        answer_block.classList.add('__answer_selected');
                        answer_block.children[0].classList.add('__answer_variant_selected');
                        answer_block.children[1].classList.add('__answer_text_selected');
                        this.$emit('check_answer', this.answer);
                    }

                }

            }

        },

        // watch: {
        //     is_check: (new_val, old__val) => {
        //         this.is_check = new_val;
        //     }
        // }
    }
</script>

<style scoped lang="scss">

    $blue: #3a69a8;
    $green: #2bc280;
    $border: #cfd9e3;
    $variant_bgc: #f5f8f9;

    .__answer {
        height: 5rem;
		display: -webkit-box;
        margin: 1rem 0;
        overflow: hidden;
        transition: 0.4s;

        &:hover {
            cursor: pointer;
            box-shadow: 0 0 10px rgba(68, 81, 98, 0.2);
        }

        %answer_child {
            display: flex;
            align-items: center;
        }

        &_variant {
            @extend %answer_child;
            justify-content: center;
            width: 5rem;
            background-color: $variant_bgc;
            border-radius: 2px 0 0 2px;
            transition: 0.5s;
            font-weight: 800;

            &_selected {
                background-color: $green;
                color: #fff;
            }
        }

        &_text {
            @extend %answer_child;
            padding: 1rem 2rem;
            border-radius: 0 2px 2px 0;
            border-top: 1px $border solid;
            border-right: 1px $border solid;
            border-bottom: 1px $border solid;
            flex-grow: 1;
            transition: 0.5s;

            &_selected {
                border-top: 1px $green solid;
                border-right: 1px $green solid;
                border-bottom: 1px $green solid;
            }
        }
    }

</style>
