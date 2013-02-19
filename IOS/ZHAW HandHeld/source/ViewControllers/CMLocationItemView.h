//
//  CMLocationItemView.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 19.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "SqLiteDatabaseManager.h"

@interface CMLocationItemView : UIView
{
    UIView *view;
    UIButton *button;
    HHFieldModel* field;
    SqLiteDatabaseManager* dbManager;
    NSNumber* linkToArticleNr;
    UIImage* locationIcon;
    NSNumber* xPosition;
    NSNumber* yPosition;
    NSString* title;

}
@property (nonatomic, retain) IBOutlet UIView *view;
@property (nonatomic, retain) IBOutlet UIButton *button;
@property (nonatomic, retain) HHFieldModel* field;
@property (nonatomic, retain) SqLiteDatabaseManager *dbManager;
@property (nonatomic, retain) NSNumber* linkToArticleNr;
@property (nonatomic, retain) UIImage* locationIcon;
@property (nonatomic, retain) NSNumber* xPosition;
@property (nonatomic, retain) NSNumber* yPosition;
@property (nonatomic, retain) NSString* title;

- (void)initializeWithField:(HHFieldModel *)f andHHManager:(SqLiteDatabaseManager*)db;

@end



