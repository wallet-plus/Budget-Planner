<?php

use yii\db\Migration;

/**
 * Class m241220_095157_create_categories
 */
class m241220_095157_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%category}}', [
            'id_category' => $this->primaryKey(),
            'id_type' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(null),
            'category_name' => $this->string(255)->defaultValue(null),
            'category_description' => $this->text()->notNull(),
            'category_image' => $this->string(255)->notNull(),
            'status' => $this->integer(1)->notNull(),
        ]);

        // Insert data
        $this->batchInsert('{{%category}}', 
            ['id_category', 'id_type', 'id_user', 'parent', 'category_name', 'category_description', 'category_image', 'status'], 
            [
                [1, 2, 0, null, 'Groceries', '', 'geM7260aDJwZDFSg.jpg', 1],
                [2, 2, 0, null, 'Vegitables', '', 'wplus_gbi_89EajKAmqVVb.jpg', 1],
                [3, 2, 0, null, 'Education', '', 'wplus_7uBU9JNVg8jE4zbc.jpg', 1],
                [4, 2, 0, null, 'Dairy Products', '', 'wplus_nwRYO8rHxSk2SD6r.jpg', 1],
                [5, 2, 0, null, 'Medical', '', 'wplus_C02LxR218fOnm7Sf.jpg', 1],
                [6, 2, 0, null, 'Food', '', 'wplus_2WUgJRkpc29lMxVm.jpeg', 1],
                [7, 2, 0, null, 'Miscellaneous Expenses', '', 'wplus_DIaMhgkjWnvWzvht.jpeg', 1],
                [8, 2, 0, null, 'Snacks', '', 'wplus_F12yW5I0HbXwkrEB.png', 1],
                [9, 2, 0, null, 'Meat', '', 'wplus_I7U62QcJHtjmMqKO.jpg', 1],
                [10, 2, 0, null, 'Internet', '', 'G3EiIx70e1B7D4oD.jpg', 1],
                [11, 2, 0, null, 'Clothing', '', 'wplus_ZxciRlQesABQQMcR.jpeg', 1],
                [12, 2, 0, null, 'Home', '', 'wplus_mINVwOvWtMGfmowD.jpeg', 1],
                [13, 2, 0, null, 'Transportation', '', 'wplus_csDHbha_FYWlsF2G.jpeg', 1],
                [14, 2, 0, null, 'Money Transfer', '', 'wplus_IelL7soZripGZvNv.jpeg', 1],
                [15, 2, 0, null, 'Games', '', 'wplus_l0av9bpIzJ_xNEnh.png', 1],
                [16, 2, 0, null, 'Beauty Products', '', 'wplus_1zmK_0OTQVdrMh2z.jpg', 1],
                [17, 3, 0, null, 'Rent', '', 'wplus_JLpvVfU3uDAKCtK7.jpeg', 1],
                [19, 2, 0, 6, 'Fruits', '', '5ZmsKDdmU2HO7X-S.jpg', 1],
                [20, 2, 0, 1, 'Baby Products', '', 'sgCMrYb_e6Nx6mD3.jpeg', 1],
                [21, 1, 0, null, 'Savings', '', 'wplus_Sp_sit9oMx9aiZYU.jpg', 1],
                [22, 2, 0, 1, 'Entertainment', '', 'wplus_89oDEvmX_yPNovfb.jpg', 1],
                [23, 2, 0, null, 'EMI Payments', '', 'wplus_3lHmVx_S5_F4PeoC.jpg', 1],
                [24, 2, 0, 1, 'Grooming', '', 'wplus_r8-IMreD58K4RgP5.jpg', 1],
                [25, 3, 0, null, 'Salary', '', 'wplus_fWaTNxytbETgQ9d9.jpeg', 1],
                [26, 2, 0, null, 'House Rent', '', 'wplus_1EqCdCXvk9U0f2lh.jpeg', 1],
                [27, 1, 0, null, 'Emergency Fund', '', 'wplus_kR0Nv51k_Xf311xd.jpg', 1],
                [28, 1, 0, null, 'Long Term Savings', '', 'wplus_3Upwg_LdmKLLmgJu.jpg', 1],
                [29, 1, 0, null, 'Short Term Savings', '', 'wplus_OBkUOaMzZ5PDj3RK.jpg', 1],
                [31, 2, 0, null, 'Travel', '', 'wplus_Fm9Zig9WG8GZDFXH.jpg', 1],
                [32, 2, 0, null, 'Donations', '', 'wplus_hpKFd3o6prwff5JM.jpeg', 1],
                [33, 1, 0, null, 'Gold (Grams)', '', 'wplus_pqyvqlsHacy3QSPO.jpg', 1],
                [34, 2, 0, null, 'Automobile', '', 'wplus_lrrGXhzQVUarjqsD.png', 1],
                [35, 2, 0, null, 'Zakat', '', 'wplus_ZDfODMFJy73CICUT.jpeg', 1],
                [36, 2, 0, null, 'Hadiya ', '', 'wplus_zI2_kShV25RptX29.jpeg', 1],
                [37, 2, 0, null, 'Fitra', '', 'wplus_i4OmGNrdPY4shBRt.jpg', 1],
                [38, 2, 0, null, 'Sadqa', '', 'wplus_ycUmNTvaXrw3TmIJ.jpg', 1],
                [39, 3, 0, null, 'Chit', '', 'wplus_44IyUFrijrsnBjcI.jpg', 1],
                [40, 3, 0, null, 'Tax Refund', '', 'wplus_DJJqM6rOMJdjkBGK.jpeg', 1],
                [41, 2, 0, null, 'Drinking Water Bottles', '', 'wplus_4tkOXPfr9Z5k1bY8.jpg', 1],
                [42, 2, 0, null, 'Electricity ', '', 'wplus_OOiflZmIjD-ohWJK.jpg', 1],
                [43, 3, 0, null, 'Stock dividend', '', 'wplus_NT0BiJUwxph-KPYT.jpg', 1],
                [44, 3, 0, null, 'Cashback', '', 'wplus_NNKSG-4_VzDJAXIk.jpg', 1],
                [45, 1, 0, null, 'Car Savings ', '', 'wplus_PGQ30j1IIebkiFX4.jpg', 1],
                [46, 3, 0, null, 'Zaggle', '', 'wplus_PldAsL1KjtRUYpVC.png', 1],
                [47, 2, 0, null, 'Furniture', '', 'wplus_Mn61sFaKK7SSHaKL.jpg', 1],
                [48, 5, 1, null, 'Gold', '', '', 1],
                [49, 5, 1, null, 'Silver', '', 'wplus_mO0Kdri9JnJh0ECF.jpg', 1],
            ]
        );
    }

    public function safeDown()
    {
        // Drop table
        $this->dropTable('{{%category}}');
    }
}