//
//  CMMainMenu.h
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/18/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "SqLiteDatabaseManager.h"
#import "CMMainMenuItem.h"

@interface CMMainMenu : UINavigationController <UITableViewDelegate, UITableViewDataSource>
{
    
    HHArticleModel* article;
    SqLiteDatabaseManager* dbManager;
    NSMutableArray* tableFieldItems;
    UITableView* tableView;
    UIViewController* rootViewController;
    
}
@property (nonatomic, retain) HHArticleModel *article;
@property (nonatomic, retain) SqLiteDatabaseManager *dbManager;
@property (nonatomic, retain) NSMutableArray *tableFieldItems;
@property (nonatomic, retain) UITableView* tableView;
@property (nonatomic, retain) UIViewController* rootViewController;

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db;

@end
